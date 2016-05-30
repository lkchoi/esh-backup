var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('community-chat')

// connection established
io.on('connection', function(socket) {
    console.log('user joined')
})

// message posted
redis.on('message', function(channel, data) {
    console.log(channel)
    console.log(data)

    io.emit('community-chat', data)
});

server.listen(3000, function() {
    console.log('listening on port 3000')
})