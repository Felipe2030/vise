@extends('site.master')
@section('content')
  <div class="container">
    <div class="container_header">
      <div class="container_header_logo">
        <img src="{{URL::asset('assets/img/logo.png')}}" alt="logo">
      </div>
      <div class="container_header_alert">
        <button type="button" id="geral">
          <div class="imagem"></div>
          <span>Felipe Henrique</span>
        </button>
      </div>
    </div>
    <div class="container_content">
      <div class="container_content_navbar">
        <ul>
          <li class="active">
            <a href="/home">
              <img src="{{URL::asset('assets/img/home.png')}}" alt="home">
              Dashboard
            </a>
          </li>

          <!-- <li>
            <a href="#">
              <img src="assets/img/supporters.png" alt="supporters">
              Clientes
            </a>
          </li> -->

          <li>
            <a href="/home/pedidos">
              <img src="{{URL::asset('assets/img/apps.png')}}" alt="apps">
              Pedidos
            </a>
          </li>

          <li>
            <a href="#">
              <img src="{{URL::asset('assets/img/payments.png')}}" alt="payments">
              Finaceiro
            </a>
          </li>

          <li>
            <a href="#">
              <img src="{{URL::asset('assets/img/communicate.png')}}" alt="communicate">
              Consultoria
            </a>
          </li>

          <li>
            <a href="#">
              <img src="{{URL::asset('assets/img/reports.png')}}" alt="reports">
              Relatorios
            </a>
          </li>

          <li>
            <a href="#">
              <img src="{{URL::asset('assets/img/notifications.png')}}" alt="notifications">
              Alertas 
              <div class="qtdAlert">0</div>
            </a>
          </li>

          <li>
            <a href="#">
              <img src="{{URL::asset('assets/img/settings.png')}}" alt="settings">
              Configuracoes
            </a>
          </li>

          <li>
            <a href="/logout">
              <img src="{{URL::asset('assets/img/logout.png')}}" alt="logout">
              Log out
            </a>
          </li>
          
        </ul>
      </div>
      <div class="container_content_dashboad">
        @yield('content_home')
      </div>
    </div>
  </div>

  <style>
    .container {
      background: #DD4B13;
      height: 100vh;
    }

    .container_header{
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #DD4B13;
      height: 96px;
    }
  
    .container_header_logo {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-left: 34px;
    }

    .container_header_alert {
      padding-right: 34px;
    }

    .container_header_logo img {
      width: 115px;
      height: 51px;
    }

    .container_content {
      background: #FCFCFD;
      height: calc(100vh - 96px);
      border-top-left-radius: 40px;
      border-top-right-radius: 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .container_content_navbar {
      border-top-left-radius: 40px;
      width: calc(247px - 40px);
      height: calc(100% - 100px);
      background: #FCFCFD;
      padding: 50px 20px;
      border: 0.5px solid #CFCFCF;
    }

    .container_content_navbar ul li {
      margin: 10px 0px;
    }

    .active a {
      background: #DD4B13 !important;
      color: #FCFCFD !important;
    }

    .container_content_navbar ul li a {
      display: flex;
      align-items: center;
      padding: 12px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 1em;
      font-weight: 600;
      background: #FCFCFD;
      color: #201F1F;
    }

    .qtdAlert {
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #FE8630;
      border-radius: 2px;
      color: #FCFCFD;
      margin-left: auto;
    }

    .container_content_navbar ul li a img {
      margin-right: 12px;
    }

    .container_content_dashboad {
      border-top-right-radius: 40px;
      width: calc(100% - 287px);
      height: calc(100% - 100px);
      padding: 50px 20px;
      background: #FCFCFD;
      border: 0.5px solid #CFCFCF;
    }

    .container_content_dashboad_header {
      display: flex;
      align-content: center;
      justify-content: space-between;
    }

    .container_content_dashboad_header_title h3 {
      font-size: 2em;
      font-weight: 600;
      line-height: 36px;
      letter-spacing: 0.01em;
      color: #201F1F;
    }

    .container_content_dashboad_header_title span {
      font-weight: 600;
      font-size: 1em;
      line-height: 17px;
      letter-spacing: 0.01em;
      color: #DD4B13;
    }

    .container_content_dashboad_header_buttons  {
      display: flex;
    }

    
    .activebtn {
      background: #DD4B13 !important;
      color: #FCFCFD !important;
    }

    .container_content_dashboad_header_buttons button {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 204px;
      height: 50px;
      margin: 0px 10px;
      padding: 0px 40px 0px 20px;
      border: 0px;
      background: #FCFCFD;
      color: #201F1F;
      font-size: 1em;
      font-weight: 500;
      border: 1px solid #DADCE6;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>

    @section('scripts')
      <script>
        const navList = document.querySelectorAll(".container_content_navbar ul li");

        navList.forEach(element => {
          if(element.querySelector("a").href == window.location.href) element.classList.add("active");
          else element.classList.remove("active");
        });

        async function modalCadastroGeral(){
          const response  = await fetch("/home/modal/modal-cadastro-geral",{method: "GET"});
          const person    = await response.text();
          const modal     = document.createElement('div');
          modal.classList.add("open-modal");
          modal.innerHTML = person;
          document.body.appendChild(modal);

          const scriptElement = modal.querySelector("script");
          const scriptContent = scriptElement.textContent;
          eval(scriptContent);
        }

        const btnGeral = document.querySelector("#geral");

        btnGeral.onclick = async () => {
          await modalCadastroGeral();
        }

        window.onload = async () => {
          const response_user = await fetch("/auth/usuario",{method: "GET"});
          const person_user   = await response_user.json();

          if(person_user.id_status_usuarios != 4){
            await modalCadastroGeral();
          }
        }
      </script>
    @stop
@stop