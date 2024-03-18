@extends('layouts.app')

@section('title', '| Crea Post')

@section('css')
    <link rel="stylesheet" href="{{asset('css/create_post.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/base.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/modalGenres.css')}}"/>
@endsection

@section('script')
    <script src="{{asset('js/search.js')}}" defer></script>
    <script src="{{asset('js/api_builder.js')}}" defer></script>
    <script src="{{asset('js/modalGenres.js')}}" defer></script>
    <script src='{{asset('js/navbar.js')}}' defer></script>
    
    <script type="text/javascript">
        const ANIME_API = "{{ route('cercaAnime') }}";
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
        <div><a href="{{route('profile')}}"><?php echo(getNome());?></a></div>
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
            <form id="search" method="GET">
                <div><input type="text" id="searchBar" placeholder="Scrivi un titolo"/></div>
                <div class="sub">
                    <div class="item">
                        <div><input type="checkbox" id="nsfw" name="nsfw" value="nsfwON"/></div>
                        <div><p>NSFW</p></div>
                    </div>
                </div>
                <div><input type="button" id="genere" value="Filtra per genere"/></div>
                <div><input type="button" id="clear" value="Pulisci"/></div>
                <div><input type="button" id="searchButton" value="Ricerca"/></div>
                
            </form>
        </div>
        
        <div name="content" id="content">
            
        </div>
    </div>

        <div name="selected" id="hidden">
            <form method="post" name="formRecensione" action="{{route('creaPost')}}">
                @csrf
                <div>
                    <input type="button" id="choseAnother" value="Seleziona un altro anime"/>
                </div>
                <input type="hidden" name="id"/>
                <input type="hidden" name="pic"/>
                <input type="hidden" name="title"/>
                <div>
                    <textarea id="textRecensione" name="recensione" placeholder="scrivi la tua recensione"></textarea>
                </div>
                <div>
                    <input type="submit" id="sendButton" name="submit" value="Invia recensione"/>
                </div>
            </form>
        </div>

        <div id="modal">
            <div id="modal-content">
                <span id="close">&times;</span>
                <div>
                    <input type="button" id="selezionaTutto" value="Seleziona tutto"/>
                    <input type="button" id="deselezionaTutto" value="Deseleziona tutto"/>
                </div>
                <div id="modal-genres">

                </div>
            </div>
        </div>
@endsection