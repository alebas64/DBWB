<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Anime Found</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel='stylesheet' href= '{{ asset('css/welcome.css') }}'>

    </head>
    <body>
        <div id = "overlay"> </div>
        <header> 
            <h1 id="title">AnimeFound</h1>
        </header>
        <section id="main">
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        </section>
    </body>
</html>
