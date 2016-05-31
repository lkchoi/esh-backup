var server = require('http').Server();
var io = require('socket.io')(server);

// connection established
io.on('connection', function(socket) {

    // message posted
    socket.on('chat.message', function(message) {
        console.log('new message: ', message);
        io.emit('chat.message', message);
    });
});

server.listen(3000, function() {
    console.log('listening on port 3000')
})