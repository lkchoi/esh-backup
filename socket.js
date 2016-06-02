var server = require('http').Server();
var io = require('socket.io')(server);
var moment = require('moment');

// connection established
io.on('connection', function(socket) {

    // message posted from client
    socket.on('community-chat:new-message', function(message) {
        console.log('community-chat:new-message', message);
        message.created_at = moment().format('YYYY-MM-DD HH:mm:ss');
        io.emit('community-chat:new-message', message);
    });

    // user joined
    socket.on('community-chat:user-joined', function(user) {
        console.log('community-chat:user-joined', user);
        if ( user != null ) {
            // console.log('user joined: ', user.username, '('+user.id+')')
            io.emit('community-chat:user-joined', user)
        }
    })
});

server.listen(3000, function() {
    console.log('listening on port 3000');
})