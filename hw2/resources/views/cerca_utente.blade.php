@extends('layouts.app')

@section('title', '| Ricerca utente')

@section('css')
    <link rel="stylesheet" href="{{asset('css/searchUser.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/base.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}"/>
@endsection

@section('script')
    <script src="{{asset('js/searchUser.js')}}" defer></script>ù
    
    <script type="text/javascript">
        const PROFILE_ROUTE = "{{ route ('profile') }}";
        const FOX_API = "{{ route('foxes')}}";
    </script>

@endsection

<?php
    use App\Models\User;
    function getNome(){
        return User::select("username")->where("id","=",session("user_id"))->first()["username"];
    }
?>

@section('content')
    <nav class="navbar">
        <div><a href="{{route('profile')}}">{{$user["username"]}}</a></div>
        <div id="links">
            <div><a href="{{route('home')}}">Homepage</a></div>
        </div>
        <div id="lines">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>
    <div name="main" id="main">
        <div name="research" id="research">
            <form id="search">
                <div><input type="text" id="searchBar" placeholder="Scrivi username da cercare"/></div>
                <div><input type="submit" id="searchButton" value="Ricerca"/></div>
            </form>
        </div>
        
        <div name="content" id="content">
            
        </div>
    </div>

@endsection