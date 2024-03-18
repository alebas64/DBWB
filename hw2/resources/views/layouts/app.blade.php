<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
        <link rel="icon" href='{{ asset('img/logo.png')}}'/>
        @yield('css')
        @yield('script')
    
    </head>
    <body> 
        @yield('content')
    </body>
</html>

