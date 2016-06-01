var server = require('http').Server();
var io = require('socket.io')(server);
var moment = require('moment');

// connection established
io.on('connection', function(socket) {

    // message posted from client
    socket.on('community-chat', function(message) {
        console.log(message.user.username + ': ' + message.content);
        message.created_at = moment().format('YYYY-MM-DD HH:mm:ss');
        io.emit('community-chat', message);
    });
});

server.listen(3000, function() {
    console.log('listening on port 3000');
})