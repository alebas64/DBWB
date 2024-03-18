@extends('layouts.logreg')

@section('title', '| Login')

@section('script')
    <script src='{{ asset('js/login.js') }}' defer></script>
    <script type="text/javascript">const LOGIN_ROUTE = "{{ route ('login') }}";</script>
@endsection

@section('form')
    <div><h1>ReviewTaku</h1></div>

    <form name="login" method="post" action="{{ route('login') }}">
        @csrf
        <div class="username">
            <div><label><input type="text" name="username" placeholder="Username" value = '{{old('username')}}'></label></div>
            <div><span style="visibility:@if($errors->has('credentials')) hidden @else hidden @endif">{{$errors->first('credentials')}}</span></div>
        </div>
        <div class="password">
            <div><label><input type ="password" name="password" placeholder="Inserisci password"/></label></div>
            <div><span style="visibility:@if($errors->has('credentials')) show @else hidden @endif">{{$errors->first('credentials')}}</span></div>
            
        </div>
        <div class="invio">
            <div><label><input type="submit" name="Invio" id="invio" disabled="false"/></label></div>
        </div>
        <div class="account">
            <div><p>Non hai un account?  <a href="{{ url('register') }}">Registrati</a></p></div>
        </div>
    </form>
@endsection
