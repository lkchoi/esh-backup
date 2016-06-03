var server = require('http').Server();
var io = require('socket.io')(server);
var moment = require('moment');
var _ = require('underscore');

/**
 * user:socket = 1:n
 * e.g., one user can have multiple tabs open, multiple devices
 */
var users = {};   // user_id: user
var userIdBySocketId = {}; // socket_id: user_id
var socketsByUserId = {}; // user_id: [socket_id, ..]

var channel = 'community-chat';

/**
 * Add a user to the appropriate tracking lists and indicate whether this is the user's first connection,
 * i.e., the user list needs to be updated and broadcast
 */
function addUser(user, socket) {

    // safety check
    if ( user == null ) {
        return false;
    }

    // is this the first (& only) connection for the user?
    var isFirstConnectionForUser = users[user.id] == null;

    // yes
    if (isFirstConnectionForUser) {

        // add user to users list
        users[user.id] = user;

        // add entry to socketsByUserId
        socketsByUserId[user.id] = [ socket.id ];
    }
    // no
    else {

        // push to the existing list of sockets for the user
        socketsByUserId[user.id].push(socket.id);
    }

    // add entry to userIdBySocketId
    userIdBySocketId[socket.id] = user.id;

    // true: update user list
    // false: no need to update user list
    return isFirstConnectionForUser;
}

/**
 * Remove the socket and possibly the user if this is the last (& only) connection,
 * i.e., the user list needs to be updated and broadcast
 */
function removeSocket(socket) {

    //  get the user id by socket id
    var user_id = userIdBySocketId[socket.id];

    // safety check
    if ( user_id == null ) {
        return false;
    }

    //  remove the socket
    delete userIdBySocketId[socket.id];

    //  remove the socket from socketsByUserId
    socketsByUserId[user_id] = _.without(socketsByUserId[user_id], socket.id);

    // is this the last (& only) connection for the user?
    var isLastConnectionForUser = socketsByUserId[user_id].length === 0;

    // yes
    if (isLastConnectionForUser) {

        // cleanup their "socketsByUserId" entry
        delete socketsByUserId[user_id];

        // cleanup their "users" entry
        delete users[user_id];
    }

    // true: update user list
    // false: no need to update user list
    return isLastConnectionForUser;
}

// socket connection established
io.on('connection', function(socket) {

    // message posted from client
    socket.on(channel+':new-message', function(message) {

        // add timestamp to message
        message.created_at = moment().format('YYYY-MM-DD HH:mm:ss');

        // broadcast new message
        io.emit(channel+':new-message', message);
    });

    // user joined
    socket.on(channel+':join', function(user) {

        // if this is the first connection for the user
        var isFirstConnectionForUser = addUser(user, socket);

        // broadcast user list update
        io.emit(channel + ':user-list', users);
    });

    // socket disconnected
    // TODO debounce for a few seconds to prevent "thrash" on page refresh
    socket.on('disconnect', function() {

        // if this was the last connection for the user
        var isLastConnectionForUser = removeSocket(socket);

        // broadcast user list update
        io.emit(channel + ':user-list', users);
    });
});

// start listening
server.listen(3000, function() {
    console.log('listening on port 3000');
});
