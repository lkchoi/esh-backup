var server = require('http').Server();
var io = require('socket.io')(server);
var moment = require('moment');
var _ = require('underscore'); // CHECKME

// user:socket = 1:n
// e.g., one user can have multiple tabs open, multiple devices

// FIXME track user object not just user id (so user list can be )
var users = {};   // user_id: user
var user_ids = {}; // socket_id: user_id
var sockets = {}; // user_id: [socket_id, ..]

// socket connection established
io.on('connection', function(socket) {
    // TODO emit complete "online users" list
    // io.emit('community-chat:user-list', ); // WIP

    // message posted from client
    socket.on('community-chat:new-message', function(message) {
        message.created_at = moment().format('YYYY-MM-DD HH:mm:ss');
        io.emit('community-chat:new-message', message);
    });

    // user joined
    socket.on('community-chat:user-joined', function(user) {
        if ( user != null ) {
            user_ids[socket.id] = user.id;

            if ( sockets[user.id] == null ) {
                sockets[user.id] = [ socket.id ]
            } else {
                sockets[user.id].push(socket.id);
            }

            io.emit('community-chat:user-joined', user);

            // console.log('user-joined: ', { user_ids: user_ids, sockets: sockets });
        }
    });

    // socket disconnected
    // FIXME debounce for a few seconds to prevent "thrash" on page refresh
    socket.on('disconnect', function() {

        // 1. get the user id by socket id
        var user_id = user_ids[socket.id];

        // 2. remove the socket
        delete user_ids[socket.id];

        // 3. remove the socket from user's sockets
        sockets[user_id] = _.without(sockets[user_id], socket.id);

        // 4. if the user has no more sockets
        if (sockets[user_id].length == 0)
        {
            // cleanup their "sockets" entry
            delete sockets[user_id];

            // announce them "offline"
            io.emit('community-chat:user-left', user_id);
        }

        // console.log('user-left: ', { user_ids: user_ids, sockets: sockets });
    })
});

// start listening
server.listen(3000, function() {
    console.log('listening on port 3000');
});
