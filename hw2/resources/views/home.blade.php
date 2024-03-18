@extends('layouts.app')

@section('title', '| Home')

@section('css')
    <link rel="stylesheet" href='{{asset('css/home.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/modal.css')}}'/>
    <link rel="stylesheet" href='{{asset('css/navbar.css')}}'/>
@endsection

@section('script')
    <script src='{{asset('js/modal.js')}}' defer></script>
    <script src='{{asset('js/fetch_update.js')}}' defer></script>
    <script src='{{asset('js/fetchs.js')}}' defer></script>
    <script src='{{asset('js/home.js')}}' defer></script>
    <script src='{{asset('js/navbar.js')}}' defer></script>
    <script type="text/javascript">
        const PROFILE_ROUTE = "{{ route ('profile') }}";
        const HOME_ROUTE = "{{ route ('home') }}";
        const IMAGE_ROUTE = "{{asset ('img')}}";
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

    <div id="content" class="fix">

    </div>
    
    <div id="modal">
        <div id="modal-content">
            <span id="close">&times;</span>
            <div id="modal-post">

            </div>
            <div id="modal-comments">
                <div id="comment-section">
                    <!--
                    <div class="comment">
                        <p class="creatore">sasistegi</p>
                        <p class="testo_commento">fn hkshfhdshcsefowfn iu uhknkfhsemxjfd</p>
                        <p class="time">2022-06-25 10:10:10</p>
                    </div>
                    <div class="comment">
                        <p class="creatore">sasistegi</p>
                        <p class="testo_commento">fn hkshfhdshcsefowfn iu uhknkfhsemxjfd</p>
                        <p class="time">2022-06-25 10:10:10</p>
                    </div>
                    <div class="comment">
                        <p class="creatore">sasistegi</p>
                        <p class="testo_commento">fn hkshfhdshcsefowfn iu uhknkfhsemxjfd</p>
                        <p class="time">2022-06-25 10:10:10</p>
                    </div>
                    <div class="comment">
                        <p class="creatore">sasistegi</p>
                        <p class="testo_commento">fn hkshfhdshcsefowfn iu uhknkfhsemxjfd</p>
                        <p class="time">2022-06-25 10:10:10</p>
                    </div>
                    -->
                </div>
                <div id="input_comment">
                    <textarea placeholder="Scrivi il commento"></textarea>
                    <input type="button" value="Invia"/>
                </div>
            </div>
        </div>
    </div>
@endsection

