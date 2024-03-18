@extends('layouts.app')

@section('title', '| Profilo')

@section('css')
    <link rel="stylesheet" href='{{asset('css/home.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/modal.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/navbar.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/profile.css')}}'/>
@endsection

@section('script')
    <script src='{{asset('js/modal.js')}}' defer></script>
    <script src='{{asset('js/fetch_update.js')}}' defer></script>
    <script src='{{asset('js/fetchs.js')}}' defer></script>
    <script src='{{asset('js/profileFound.js')}}' defer></script>
    <script src='{{asset('js/navbar.js')}}' defer></script>
    <script type="text/javascript">
        const PROFILE_ROUTE = "{{ route ('profile') }}";
        const HOME_ROUTE = "{{ route ('home') }}";
        const USER = "{{$utente["username"]}}";
        const FOX_API = "{{ route('foxes')}}";
        const IMAGE_ROUTE = "{{asset ('img')}}";
    </script>
@endsection

<?php
    use App\Models\User;
    function getNome(){
        return User::select("nascita,email,sesso")->where("id","=",session("user_id"))->first()["username"];
    }
?>

@section('content')
    <nav class="navbar">
        <!--
        <div><a href="#"><?php //echo(getNome());?></a></div>-->
        <div><a href="{{route('home')}}">Homepage</a></div>
        <div id="links">
            <div><a href="{{route('search_page')}}">Ricerca utente</a></div> <!-- ricerca utente -->
            <div><a href="{{route('cercaAnime')}}">Crea un post</a></div>
            <div><a href="{{route('logout')}}">Sloggati</a></div>
        </div>
        <div id="lines">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div id="links_lines">
            <div><a href="{{route('search_page')}}">Ricerca utente</a></div> <!-- ricerca utente -->
            <div><a href="{{route('cercaAnime')}}">Crea un post</a></div>
            <div><a href="{{route('logout')}}">Sloggati</a></div>
        </div>
    </nav>
    <div id="main">
        <div id="profile">
            <div class="dati-attuali">
                <h1>Informazioni profilo</h1>
                <div>
                    <span>Username</span>
                    <p id="username">{{$utente["username"]}}</p>        
                </div>
                <div>
                    <span>Data di nascita</span>
                    <p id="data di nascita">{{$utente["nascita"]}}</p>       
                </div>
                <div>
                    <span>Genere</span>
                    <p id="genere">
                        @if($utente["sesso"]=="u")
                            Uomo
                        @elseif($utente["sesso"]=="d")
                            Donna
                        @else
                            Non binario
                        @endif
                    </p>     
                </div>
            </div>
        </div>
        <div>
            <div class="titolo">
                <p>I post di {{$utente["username"]}}</p>
            </div>
            <div name="content" id="content">
                
            </div>
        </div>
        
    </div>
    <div id="modal">
        <div id="modal-content">
            <span id="close">&times;</span>
            <div id="modal-post">

            </div>
            <div id="modal-comments">
                <div id="comment-section">
                    
                </div>
                <div id="input_comment">
                    <textarea placeholder="Scrivi il commento"></textarea>
                    <input type="button" value="Invia"/>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection