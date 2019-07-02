<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel|Socket</title>
    </head>
    <body>

        <ul id="messages">
            <li v-repeat="user: users">@{{user}}</li>
        </ul>
            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.15/vue.min.js"></script>
        <script>
            var socket = io('http://192.168.10.10:3000');
            new Vue({
                el:'body',
                data: {
                    users: [],
                },
                ready: function(){
                    socket.on('test-channel:MyEvent', function(data){
                        console.log(data);
                        this.users.push(data);
                    }.bind(this))
                }
            })
        </script>
    </body>
</html>
