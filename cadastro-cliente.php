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

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mais
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="cadastro-livro.php">Cadastrar livros</a></li>
                <li><a class="dropdown-item" href="consultar-emprestimo.php">Consultar empréstimos</a></li>
               <!-- <li><a class="dropdown-item" href="#">Consultar clientes</a></li>
                 <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"></a></li> -->
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true"></a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

    <div class="container">
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
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>