@extends('layouts.app')

@section('css')
    <link rel='stylesheet' href= '{{ asset('css/base.css') }}'>
@endsection    

@section('content')
    <div id="main">
        @yield('form')
    </div>
@endsection