@extends('site.master')
@section('content')

<style>
    /* Estilo para todos os campos de entrada de texto */
input[type="text"],
input[type="password"],
input[type="email"],
input[type="number"] {
  display: block;
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
}

/* Estilo para rótulos dos campos */
label {
  display: block;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Estilo para botões de envio */
button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

/* Estilo para mensagens de erro */
.error {
  color: red;
  margin-bottom: 10px;
}

</style>


<h1>Formulário de Contato</h1>
    <form action="processar_formulario.php" method="post">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="assunto">Assunto:</label>
      <input type="text" id="assunto" name="assunto" required>
      
      <label for="mensagem">Mensagem:</label>
      <textarea id="mensagem" name="mensagem" required></textarea>
      
      <button type="submit">Enviar</button>
    </form>
@stop