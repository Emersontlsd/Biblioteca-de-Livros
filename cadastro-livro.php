<?php

if(isset($_POST['cadastrar'])){

    include_once('config.php');

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $num_copias = $_POST['num_copias'];
    

    // executa o insert no banco de dados
    $result = mysqli_query($conn, "INSERT INTO livros(titulo, autor, isbn, num_copias) 
    VALUES ('$titulo', '$autor', '$isbn', '$num_copias')");

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

    <title>CADASTRO DE LIVRO</title>
</head>
<body>
<form action="?cadastro-cliente" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label>TITULO DO LIVRO</label>
        <input type="text" name="titulo" class="form-control">        
    </div>
    <div class="mb-3">
        <label>AUTOR</label>
        <input type="text" name="autor" class="form-control">        
    </div>
    <div class="mb-3">
        <label>ISBN</label>
        <input type="text" name="isbn" class="form-control">        
    </div>
    <div class="mb-3">
        <label>NÚMERO DE CÓPIAS</label>
        <input type="number" name="num_copias" class="form-control">        
    </div>
    <div class="mb-3">
        <button type="submit" name="cadastrar" class="btn btn-primary">
            CADASTRAR
        </button>
    </div>
</form>
</body>
</html>