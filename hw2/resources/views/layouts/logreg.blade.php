@extends('layouts.app')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href= '{{ asset('css/base.css') }}'>
    <link rel='stylesheet' href= '{{ asset('css/login_register.css') }}'>
@endsection    

@section('content')
    <div id="main">
        @yield('form')
    </div>
@endsection