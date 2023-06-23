<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Laravel React</title>
    <script>
        const csrf_token = '{{csrf_token()}}';
    </script>
</head>
<body>

    <p>{{session('SpotifyAcessToken') ?? "Sem acess_token"}}</p>

    <div id="playlist"></div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
