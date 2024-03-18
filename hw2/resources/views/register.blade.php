@extends('layouts.logreg')

@section('title', '| Registrazione') 

@section('script')
    <script src='{{ asset('js/login.js') }}' defer></script>
    <script type="text/javascript">const REGISTER_ROUTE = "{{ route ('register') }}";</script>
@endsection

@section('form')
    <div><h1>ReviewTaku</h1></div>
    <form name="registrazione" method="post" autocomplete="off" action="{{ route('register') }}">
        @csrf
        <div class="username">
            <div><input type="text" name="username" placeholder="Username" value = '{{old('username')}}'/></div>
            <div>
                <span style="visibility:@if($errors->has('usernameCh')) show @else hidden @endif">{{$errors->first('usernameCh')}}</span>
                <span style="visibility:@if($errors->has('usernameUsed')) show @else hidden @endif">{{$errors->first('usernameUsed')}}</span>
            </div>
        </div>
        <div class="password">
            <div><input type ="password" name="password" placeholder="Inserisci password" value = '{{old('password')}}'/></div>
            <div><span style="visibility:@if($errors->has('pswLen')) show @else hidden @endif">{{$errors->first('pswLen')}}</span></div>
        </div>
        <div class="passwordC">
            <div><input type ="password" name="passwordC" placeholder="Conferma password" value = '{{old('passwordC')}}'/></div>
            <div><span style="visibility:@if($errors->has('pswMs')) show @else hidden @endif">{{$errors->first('pswMs')}}</span></div>
        </div>
        <div class="email">
            <div><input type="text" name="email" placeholder="Email" value = '{{old('email')}}'/></div>
            <div>
                <span style="visibility:@if($errors->has('emailCh')) show @else hidden @endif">{{$errors->first('emailCh')}}</span>
                <span style="visibility:@if($errors->has('emailUsed')) show @else hidden @endif">{{$errors->first('emailUsed')}}</span>
            </div>
        </div>
        <div class="date">
            <div><input name="nascita" type="date" value='{{old('nascita')}}'/></div>
            <div><span style="visibility:@if($errors->has('nascita')) show @else hidden @endif">{{$errors->first('nascita')}}</span></div>
        </div>
        <div class="sesso">
            <div><p>Sesso</p></div>
            <div class="sub">
                <div class="item">
                    <div><input type="radio" name="sesso" value="u"></div>
                    <div><p>Uomo</p></div> 
                </div>
                <div class="item">
                    <div><input type="radio" name="sesso" value="d"></div>
                    <div><p>Donna</p></div>
                </div>
                <div class="item">
                    <div><input type="radio" name="sesso" value="n"></div>
                    <div><p>!(10101)</p></div>
                </div>
            </div>
            <div><span style="visibility:@if($errors->has('sessoUnselected')) show @else hidden @endif">{{$errors->first('sessoUnselected')}}</span></div>
        </div>
        <div class="invio">
            <div><input type="submit" name="Invio" id="invio" disabled/></div>
        </div>
        <p class="pd"> {{$errors}} </p>
        <div class="account">
            <div><p>Hai un account?  <a href="{{ url('login') }}">Accedi</a></p></div>
        </div>
    </form>
@endsection