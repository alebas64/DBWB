@extends('layouts.app')

@section('title', '| Profilo')

@section('css')
    <link rel="stylesheet" href='{{asset('css/home.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/modal.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/navbar.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/profile.css')}}'/>
@endsection

@section('script')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src='{{asset('js/modal.js')}}' defer></script>
    <script src='{{asset('js/fetch_update.js')}}' defer></script>
    <script src='{{asset('js/fetchs.js')}}' defer></script>
    <script src='{{asset('js/profile.js')}}' defer></script>
    <script src='{{asset('js/navbar.js')}}' defer></script>
    <script type="text/javascript">
        const PROFILE_ROUTE = "{{ route ('profile') }}";
        const HOME_ROUTE = "{{ route ('home') }}";
        const IMAGE_ROUTE = "{{asset ('img')}}";
        const TOKEN = "{{ csrf_token() }}";
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
        <!--
        <div><a href="#"><?php //echo(getNome());?></a></div>-->
        <div><a href="{{route('home')}}">Homepage</a></div>
        <div id="links">
            <div><a href="{{route('search_page')}}">Ricerca utente</a></div>
            <div><a href="{{route('cercaAnime')}}">Crea un post</a></div>
            <div><a href="{{route('logout')}}">Sloggati</a></div>
        </div>
        <div id="lines">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div id="links_lines">
            <div><a href="{{route('search_page')}}">Ricerca utente</a></div>
            <div><a href="{{route('cercaAnime')}}">Crea un post</a></div>
            <div><a href="{{route('logout')}}">Sloggati</a></div>
        </div>
    </nav>
    <div id="main">
        <div id="profile">
            <div class="dati-attuali">
                <h1>Dati attuali</h1>
                <div>
                    <span>Username</span>
                    <p id="username">{{$user["username"]}}</p>        
                </div>
                <div>
                    <span>Data di nascita</span>
                    <p id="data di nascita">{{$user["nascita"]}}</p>       
                </div>
                <div>
                    <span>Genere</span>
                    <p id="genere">
                        @if($user["sesso"]=="u")
                            Uomo
                        @elseif($user["sesso"]=="d")
                            Donna
                        @else
                            Non binario
                        @endif
                    </p>     
                </div>
                <div>
                    <span>Email</span>
                    <p id="email">{{$user["email"]}}</p>      
                </div>
            </div>
            <form method="POST" action="{{route('changeValues')}}">
                <div>
                    <span>Vuoi cambiare il tuo username?</span>
                    <input type="text" id="usernameC" placeholder="Inserisci il nuovo username"/>
                    <span id="usernameE" class="error"></span> 
                </div>
                <div>
                    <span>Vuoi cambiare la password?</span>
                    <input type="password" id="passwordC" placeholder="Inserisci nuova password"/>
                    <input type="password" id="passwordCC" placeholder="Conferma password"/>
                    <span id="passwordE" class="error"></span>
                </div>
                <div>
                    <span>Vuoi cambiare la tua email?</span>
                    <input type="text" id="emailC" placeholder="Inserisci la nuova email"/>
                    <span id="emailE" class="error"></span>
                </div>
                <div>
                    <input type="submit" value="Cambia!" id="submit"/>
                </div>
            </form>
        </div>
        <div>
            <div class="titolo">
                <p>I miei post</p>
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