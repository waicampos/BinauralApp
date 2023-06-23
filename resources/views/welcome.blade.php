<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel React</title>

</head>
<body>

    <p>{{session('SpotifyAcessToken') ?? "Sem acess_token"}}</p>

    <div id="player"></div>
    <!-- <div id="hello-react"></div>
    <div id="counter"></div>
    <div id="binaural"></div> -->


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>