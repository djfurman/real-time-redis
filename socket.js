/**
 * Created by dfurman on 1/22/16.
 */

var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message', function(channel, message){
    //Initial proof of concept simply logging the message to the console as is
    //console.log('Message Received');
    //console.log(message);

    message = JSON.parse(message);
    console.log("New User has joined: " + message.data.username);
})

server.listen(3000);
