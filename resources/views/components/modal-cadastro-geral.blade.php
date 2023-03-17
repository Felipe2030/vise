<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    
<div class="modal">
    <div class="overlay"></div>
    <div class="content">
        <form method="post" id="formulario">
            <span style="font-size: 1.2em;">Informações do usuário</span>

            <div class="row">
                <div class="column">
                    <label for="name">Nome completo</label>
                    <input type="text" name="name" id="name">
                </div>

                <div class="column">
                    <label for="telefone">Telefone de contato</label>
                    <input type="text" name="telefone" id="telefone">
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </div>
            </div>

            <div class="row">
                <div class="column">
                <label for="estabelecimento">Nome do estabelecimento</label>
                        <input type="text" name="estabelecimento" id="estabelecimento">
                </div>

                <div class="column">
                    <label for="documento">Documento pessoal ou da empresa</label>
                    <select name="documento" id="documento">
                        <option value="cnpj">CNPJ</option>
                        <option value="cpf">CPF</option>
                    </select>
                </div>

                <div class="column campos">
                    <label>Qual o número do CNPJ ?</label>
                    <input type="text" name="numero_documento">
                </div>

                <div class="column campos d-none">
                    <label>Qual o número do CPF ?</label>
                    <input type="text" name="numero_documento">
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label>Cidade</label>
                    <input type="text" name="cidade">
                </div>

                <div class="column">
                    <label>Endereço</label>
                    <input type="text" name="endereco">
                </div>

                <div class="column">
                    <label>Número</label>
                    <input type="number" name="numero">
                </div>

                <div class="column">
                    <label>Cep</label>
                    <input type="text" name="cep">
                </div>
            </div>

            <div class="row row-reverse aling-btn">
                <button type="button" id="enviar">Salvar</button>
                <button type="button" id="fechar">Fechar</button>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        margin: 0px;
    }

    .modal {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay {
        background: #000;
        position: absolute;
        opacity: 0.50;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
    }

    .content {
        position: relative;
        background: #FFF;
        box-shadow: 25px 17.68px 114.72px rgba(0, 0, 0, 0.4);
        border-radius: 12px;
        min-height: 560px;
        min-width: 860px;
        z-index: 1;
        padding: 20px;
    }

    .content form {
        width: 100%;
    }

    .content form span {
        text-align: left;
        font-weight: 600;
        color: #201F1F;
        margin-left: 4px;
        margin-bottom: 40px;
        display: block;
    }

    .content form .row {
        width: 100%;
        display: flex;
        margin: 14px 0px;
    }

    .content form .row .column  {
        width: 100%;
        margin: 0px 4px;
    }

    .content form .row .column label {
        display: block;
        font-weight: 600;
        font-size: 0.8em;
        color: #201F1F;
        margin: 0px 0px 4px 0px;
    }

    .content form .row .column input {
        width: calc(100% - 8px);
        height: 22px;
        border: 0px;
        border-radius: 4px;
        padding: 4px;
        border: 1px solid #E5E5E5;
        box-shadow: 4px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .content form .row .column select {
        width: 100%;
        height: 31px;
        border: 0px;
        border-radius: 4px;
        padding: 2px;
        border: 1px solid #E5E5E5;
        box-shadow: 4px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .row-reverse {
        flex-direction: row-reverse;
    }

    .aling-btn {
        position: absolute;
        bottom: 10px;
        right: 24px;
    }

    .content form .row button {
        width: 120px;
        height: 36px;
        border: 0px;
        font-weight: 600;
        color: #FCFCFD;
        border-radius: 4px;
        font-size: 0.8em;
        color: #FBECE6;
        cursor: pointer;
    }

    .content form .row button:nth-child(1) {
        background: #193F34;
        margin-left: 4px;
    }

    .content form .row button:nth-child(2) {
        background: #DD4B13;
        margin-right: 4px;
    }
</style>

<script>
    (async () => {
        const response = await fetch("/auth/usuario",{method: "GET"});
        const person   = await response.json();

        let campos = document.querySelectorAll(".campos");
        let select = document.querySelector("#documento");

        document.querySelector("input[name='name']").value = person.fullname;
        document.querySelector("input[name='telefone']").value = person.telefone;
        document.querySelector("input[name='email']").value = person.email;
        document.querySelector("input[name='estabelecimento']").value = person.estabelecimento;

        document.querySelectorAll("select[name='documento'] option").forEach(option => {
            if(person.documento === "cnpj") campos[0].remove("d-none"); 
            else campos[0].classList.add("d-none");

            if(person.documento === "cpf") campos[1].classList.remove("d-none")
            else campos[1].classList.add("d-none"); 
      
            if(option.value === person.documento) option.selected = true;
            else option.selected = false;
        });
        
        document.querySelectorAll("input[name='numero_documento']").forEach(input => {
            input.value = person.numero_documento;
        });

        document.querySelector("input[name='cidade']").value = person.cidade;
        document.querySelector("input[name='endereco']").value = person.endereco;
        document.querySelector("input[name='numero']").value = person.numero;
        document.querySelector("input[name='cep']").value = person.cep;

        select.onchange = async () => {
            campos.forEach(campo => {
                if(campo.classList.value.split(" ").includes("d-none")) campo.classList.remove("d-none");
                else campo.classList.add("d-none"); 
            });
        }

        let enviar = document.querySelector("#enviar");
        let id_usuarios = person.id;

        enviar.onclick = async () => {
            const formulario = document.querySelector("#formulario");
            const formData   = new FormData(formulario);
            const response   = await fetch(`/usuarios/update/${id_usuarios}`,{ method: "POST", body: formData });
            const person     = await response.json();
            
            alert(person.message);
            if(person.status) window.location.href = '/home';
        }

        let fechar = document.querySelector("#fechar");
        let modal  = document.querySelector(".open-modal");
        
        fechar.onclick = async () => {
           document.body.removeChild(modal);
        }
    })();
</script>
</body>
</html>