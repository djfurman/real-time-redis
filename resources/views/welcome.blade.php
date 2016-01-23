<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>

        <h1>New Users</h1>

        <ul>
            <li v-for="user in users" track-by="$index">@{{ user }}</li>
        </ul>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.4/socket.io.js"></script>

        <script>
            var socket = io('http://192.168.10.10:3000');
            new Vue({
               el: 'body',

                data:{
                    users: []
                },

                ready: function(){
                    socket.on('test-channel:UserSignedUp', function(data) {
                       this.users.push(data.username);
                    }.bind(this));
                }
            });
        </script>
    </body>
</html>
