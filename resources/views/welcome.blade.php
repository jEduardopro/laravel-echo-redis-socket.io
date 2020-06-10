<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Laravel Broadcast Redis Socket.IO</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>
        <div class="container" id="app">
            <h1 class="text-muted">Laravel Broadcast Redis Socket.IO</h1>
            <div id="chat-notification"></div>
        </div>

        <script>
            window.laravelEchoPort = '{{env("LARAVEL_ECHO_PORT")}}'
        </script>
        <script src="//{{request()->getHost()}}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
        <script src="{{asset('js/app.js')}}"></script>

        <script>
            const userId = '{{auth()->id()}}';
            window.Echo.channel('public-message-channel')
                .listen('.MessageEvent', (e) => {
                    $("#chat-notification").append('<div class="alert alert-warning">'+e.message+'</div>');
                });
            window.Echo.private('message-channel.' + userId)
                .listen('.MessageEvent', (e) => {
                    $("#chat-notification").append('<div class="alert alert-danger">'+e.message+'</div>');
                })
            window.Echo.private('App.User.' + userId)
                .notification((e) => {
                    $("#chat-notification").append('<div class="alert alert-info">'+e.status+'</div>');
                })
        </script>
    </body>
</html>
