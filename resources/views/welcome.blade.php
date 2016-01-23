<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>

        <h1>New Users</h1>

        <ul>
            {{--
            Display the list for all users signing up for the site using Vue
            The 'track-by' index argument allow for duplicative values for the demo

            The '@' symbol in the {{ user }} syntax indicates
              to the blade templating engine to ignore that and allow JavaScript to parse it
            --}}
            <li v-for="user in users" track-by="$index">@{{ user }}</li>
        </ul>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.4/socket.io.js"></script>

        <script>
            //Set up the socket for monitoring
            var socket = io('http://192.168.10.10:3000');

            //Establish the Root vue instance
            new Vue({
               el: 'body',

                data:{
                    users: []
                },

                //As soon as the page loads...
                ready: function(){
                    //...start listening for any UserSignedUp news on the test-channel wire
                    //       then, use Vue's data driven reactivity to display the real-time content
                    socket.on('test-channel:UserSignedUp', function(data) {
                       this.users.push(data.username);
                    }.bind(this));
                }
            });
        </script>
    </body>
</html>
