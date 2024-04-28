    <?php
    // Incluir o arquivo de configuração do banco de dados
    include_once("config.php");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL para buscar os clientes cadastrados
    $sqlClientes = "SELECT idLeitor, nome FROM leitor";
    $resultClientes = $conn->query($sqlClientes);

    // Consulta SQL para buscar os livros cadastrados
    $sqlLivros = "SELECT idLivro, titulo FROM livros";
    $resultLivros = $conn->query($sqlLivros);

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>

<!DOCTYPE html>
<html>
<head>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>EMPRÉSTIMO DE LIVRO</title>
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
                <li><a class="dropdown-item" href="#">Consultar livros</a></li>
                <li><a class="dropdown-item" href="#">Consultar clientes</a></li>
                <!-- <li><hr class="dropdown-divider"></li>
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

    <h1>Empréstimo de Livro</h1>
    <form action="processar-emprestimo.php" method="POST">
        <label for="id_Leitor">Selecione o cliente:</label>
        <select id="id_Leitor" name="id_Leitor" required>
        
        <?php
        // Exibe os clientes como opções no menu suspenso
        if ($resultClientes->num_rows > 0) {
            while ($rowCliente = $resultClientes->fetch_assoc()) {
                echo "<option value='" . $rowCliente["idLeitor"] . "'>" . $rowCliente["nome"] . "</option>";
            }
        } else {
            echo "<option value=''>Nenhum cliente encontrado</option>";
        }
        ?>
    </select><br><br>

    <label for="id_Livro">Selecione o livro:</label>
    <select id="id_Livro" name="id_Livro" required>
        <?php
        // Exibe os livros como opções no menu suspenso
        if ($resultLivros->num_rows > 0) {
            while ($rowLivro = $resultLivros->fetch_assoc()) {
                echo "<option value='" . $rowLivro["idLivro"] . "'>" . $rowLivro["titulo"] . "</option>";
            }
        } else {
            echo "<option value=''>Nenhum livro encontrado</option>";
        }
        ?>

        </select><br><br>

        <label for="data_emprestimo">Data do empréstimo:</label>
        <input type="date" id="data_emprestimo" name="data_emprestimo" required><br><br>

        <label for="data_devolucao">Data de devolução:</label>
        <input type="date" id="data_devolucao" name="data_devolucao" required><br><br>

        
        <input type="submit" name="Emprestar" value="Emprestar">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>