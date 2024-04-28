<?php

if(isset($_POST['cadastrar'])){

    include_once('config.php');

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['data_nasc'];

    // executa o insert no banco de dados
    $result = mysqli_query($conn, "INSERT INTO leitor(nome, email, cpf, endereco, telefone, data_nasc) 
    VALUES ('$nome', '$email', '$cpf', '$endereco', '$telefone', '$data_nasc')");

    // verificando se o cadastro foi efetuado
    if($result){
        // sim, emite a mensagem de sucesso
        echo "<script>alert('Dados cadastrados com sucesso!'); </script>";
    }else {
        // não, emite a mensagem de erro
        echo " <script>alert ('Erro ao cadastrar os dados. " . mysqli_error($conn) . " '); </script>";
    }

    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CADASTRO LEITOR</title>
</head>
<body>
<form action="?cadastro-cliente" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label>NOME</label>
        <input type="text" name="nome" class="form-control">        
    </div>
    <div class="mb-3">
        <label>CPF</label>
        <input type="number" name="cpf" class="form-control">        
    </div>
    <div class="mb-3">
        <label>E-MAIL</label>
        <input type="email" name="email" class="form-control">        
    </div>
    <div class="mb-3">
        <label>ENDEREÇO</label>
        <input type="text" name="endereco" class="form-control">        
    </div>
    <div class="mb-3">
        <label>TELEFONE</label>
        <input type="number" name="telefone" class="form-control">        
    </div>
    <div class="mb-3">
        <label>DATA DE NASCIMENTO</label>
        <input type="date" name="data_nasc" class="form-control">        
    </div>
    <div class="mb-3">
        <button type="submit" name="cadastrar" class="btn btn-primary">
            CADASTRAR
        </button>
    </div>
</form>
</body>
</html>