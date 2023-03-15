<div class="modal d-none">
    <div class="modal_overlay"></div>
    <div class="modal_content">
        <form method="POST">
            <span>Incluir venda</span>
            
            <div class="row">
                <div>
                    <label for="data">Data</label> <br>
                    <input type="date" name="data" id="data" placeholder="00/00/0000">
                </div>

                <div>
                    <label for="cliente">Cliente</label> <br>
                    <select name="cliente" id="cliente"></select>
                    <button type="button" class="cadastrar" >+</button>
                </div>

                <div>
                    <label for="tipo_venda">Tipo de venda</label> <br>
                    <select name="tipo_venda" id="tipo_venda"></select>
                    <button type="button" class="cadastrar">+</button>
                </div>      
                
                <div>
                    <label for="tipo_venda">Forma de PGTO</label> <br>
                    <select name="tipo_venda" id="tipo_venda"></select>
                    <button type="button" class="cadastrar">+</button>
                </div> 
            </div>

            <span style="font-size: 18px;">Itens do pedido</span>

            <div class="row">
                <div>
                    <label for="item">Item</label> <br>
                    <select style="width: calc(100% - 20px)" name="item" id="item"></select>
                </div>

                <div>
                    <label for="quantidade">Quantidade</label> <br>
                    <input type="number" name="quantidade" id="quantidade" placeholder="Digite a quantidade!">
                </div>

                <div>
                    <label for="preco_venda">Preço de venda</label> <br>
                    <input type="text" name="preco_venda" id="preco_venda" placeholder="Digite o preço de venda!">
                </div>      
            </div>

            <div class="modal_buttons">
                <button type="button" class="close">Fechar</button>
                <button type="button">Incluir venda</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal_content {
        padding: 20px;
    }

    .row {
        display: flex;
        width: 100%;
    }

    .d-none {
        display: none;
    }

    .d-flex {
        display: flex;
    }

    .modal_content form {
        display: flex;
        text-align: center;
        flex-direction: column;
        height: 180px;
    }

    .modal_content form div {
        margin: 5px 0px;
        width: 100%;
    }

    .modal_content form span {
        text-align: left;
        padding: 0px 12px;
        margin: 0px 0px 10px 0px;
        font-weight: 600;
        font-size: 30px;
        line-height: 36px;
        color: #201F1F;
    }

    .modal_content form label {
        display: block;
        text-align: left;
        padding: 0px 12px;
        font-weight: 700;
        font-size: 16px;
        line-height: 1px;
        color: #201F1F;
    }

    .modal_content form a {
        float: left;
        padding: 8px 12px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9em;
    }

    .modal_content form input {
        width: calc(100% - 42px);
        border: 0px;
        height: 20px;
        border-radius: 4px;
        padding: 10px;
        border: 1px solid #E5E5E5;
        box-shadow: 4px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .modal_content form select {
        width: calc(100% - 60px);
        border: 0px;
        height: 40px;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #E5E5E5;
        box-shadow: 4px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .modal_content form div .cadastrar {
        width: 40px;
        height: 40px;
        border: 0px;
        border-radius: 4px;
        background: #DD4B13;
        color: #FFF;
        font-weight: 600;
        font-size: 1em;
        cursor: pointer;
    }
</style>

<script>
    const btnClose = document.querySelector(".close");
    console.log(btnClose);
</script>