var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();


redis.subscribe('test-channel');
console.log(redis);
redis.on('message', function(channel, message){
  console.log('in---');
  console.log(message);
  console.log(channel);
});

server.listen(3000);