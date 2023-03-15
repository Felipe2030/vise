@extends('site.master')
@section('content')

    <!-- <h2>Login</h2> -->

    <!-- <form>
        <input type="email" name="email" id="email" value="camila69@hotmail.com">
        <input type="password" name="password" id="password" value="123">
        <button id="btn-login">Login</button>
    </form> -->

    <style>
        .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        .login-form {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        max-width: 400px;
        width: 100%;
        }

        h2 {
        margin-top: 0;
        font-size: 24px;
        text-align: center;
        }

        label {
        display: block;
        margin-bottom: 5px;
        }

        input {
        width: calc(100% - 22px);
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        }

        button[type="submit"] {
        background-color: #008CBA;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        }

        button[type="submit"]:hover {
        background-color: #0077A3;
        }

    </style>

    <div class="container">
      <form class="login-form" method="POST" action="/login">
        <h2>Login</h2>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
      </form>
    </div>

    @section('scripts')
        <!-- <script src="/dist/login.js"></script> -->
    @stop
@stop