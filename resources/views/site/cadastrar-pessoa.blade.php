@extends('site.master')
@section('content')
    <div class="container">
        <div class="container_card">
            <div class="container_card_form">
                <div class="container_card_form_header">
                    <img src="{{URL::asset('assets/img/logo.png')}}" alt="logo">
                </div>
                <div class="container_card_form_descricao">
                    <span>Vamos configurar sua conta, leva só 1 minuto.</span>
                </div>
                <form id="formulario_login" action="/login" method="POST">
                    <div>
                        <label for="name">Nome completo</label>
                        <input type="name" name="name" id="name" placeholder="Digite seu nome completo!">
                    </div>

                    <div>
                        <label for="telefone">Telefone de contato</label>
                        <input type="text" name="telefone" id="telefone" placeholder="Digite sua telefone!">
                    </div>
                </form>
            </div>
            <div class="container_card_buttons">
                <button type="button" onclick="submit()">Avançar</button>
            </div>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        .container_card {
            width: 500px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .container_card_form {
            background: #DD4B13;
            height: 450px;
            border-radius: 10px
        }

        .container_card_form_header {
            display: flex;
            justify-content: center;
            padding: 22px;
        }

        .container_card_form_descricao {
            display: flex;
            justify-content: flex-end;
            height: 67px;
            padding: 22px;
        }

        .container_card_form form {
            display: flex;
            text-align: center;
            flex-direction: column;
            height: 180px;
        }

        .container_card_form form div {
            margin: 5px 0px;
        }

        .container_card_form form label {
            display: block;
            text-align: left;
            padding: 0px 12px;
            font-weight: 700;
            font-size: 16px;
            line-height: 26px;
            color: #FBECE6;
        }

        .container_card_form form a {
            float: left;
            padding: 8px 12px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9em;
        }

        .container_card_form form input {
            width: calc(100% - 42px);
            border: 0px;
            height: 20px;
            border-radius: 4px;
            padding: 10px;
        }

        .container_card_form_descricao span {
            font-style: normal;
            font-weight: 700;
            font-size: 1.1em;
            line-height: 20px;
            color: #FBECE6;
            width: 255px;
        }

        .container_card_form_header img {
            width: 115px;
            height: 51px;
        }

        .container_card_buttons {
            margin-top: 10px;
            display: flex;
        }

        .container_card_buttons button {
            width: 100%;
            height: 50px;
            border: 0px;
            font-weight: 600;
            color: #FCFCFD;
            border-radius: 10px;
            font-size: 1.2em;
            line-height: 26px;
            color: #FBECE6;
            cursor: pointer;
        }

        .container_card_buttons button:nth-child(1) {
            background: #193F34;
            margin-right: 4px;
        }

        .container_card_buttons button:nth-child(2) {
            background: #DD4B13;
            margin-left: 4px;
        }
    </style>

    @section('scripts')
        <script>
            async function submit(){
                try {
                    const id_usuarios = sessionStorage.getItem("usuario_id");
                    const formulario  = document.querySelector("#formulario_login");
                    const formData = new FormData(formulario);
                    const response = await fetch(`/cadastrar/pessoas/${id_usuarios}`,{ method: "POST", body: formData });
                    const person   = await response.json();
                    // alert(person.message);
                    window.location.href = '/cadastrar/pessoas/tipo';
                } catch (error) {
                    alert(error);
                }
            }
        </script>
    @stop
@stop