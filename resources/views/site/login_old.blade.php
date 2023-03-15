@extends('site.master')
@section('content')
    <h2>Login</h2>

    @if(Auth::user())
        <h3>Já esta logado</h3>
    @else
        <div id="messages"></div>
        
        <form>
            <input type="email" name="email" id="email" value="camila69@hotmail.com">
            <input type="password" name="password" id="password" value="123">
            <button id="btn-login">Login</button>
        </form>
    @endif

    @section('scripts')
        <script src="/dist/login.js"></script>
    @stop
@stop