@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href= '{{asset('css/style2.css') }}'>
    @yield('css1')
@endsection('css')


@section('content')
    <header>
        <h1 id="title">AnimeFound</h1>
        <div id="link">
            <a href="{{ asset('home') }}">HOME </a>
            @yield('link')
            <a href="{{ asset('logout') }}">LOGOUT </a>
        </div>
    </header>

    <section id = 'barra_ricerca'>
        <h1> Ricerca per: </h1>
            @yield('search')
        </section>
        @yield('text')
   
@endsection