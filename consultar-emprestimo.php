<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Empréstimos</title>
    <!-- Adicione a folha de estilo Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mais
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="cadastro-livro.php">Cadastrar livro</a></li>
                <!--  <li><a class="dropdown-item" href="#">Consultar clientes</a></li>
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

    <h1 class="text-center">Consulta de Empréstimos</h1>
    <!-- Use a classe table do Bootstrap para estilizar a tabela -->
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">LEITOR</th>
                <th scope="col">LIVRO</th>
                <th scope="col">DATA DO EMPRÉSTIMO</th>
                <th scope="col">DATA DO DEVOLUÇÃO</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Incluir o arquivo de configuração do banco de dados
            include_once("config.php");

            // Consulta SQL para buscar os empréstimos realizados
            $sqlEmprestimos = "SELECT emprestimo.idEmprestimo, leitor.nome AS nome_leitor, livros.titulo AS titulo_livro, emprestimo.data_emprestimo, emprestimo.data_devolucao
                               FROM emprestimo
                               INNER JOIN leitor ON emprestimo.idLeitor = leitor.idLeitor
                               INNER JOIN livros ON emprestimo.idLivro = livros.idLivro
                               ORDER BY emprestimo.idEmprestimo DESC";
            $resultEmprestimos = $conn->query($sqlEmprestimos);

            if ($resultEmprestimos->num_rows > 0) {
                while ($row = $resultEmprestimos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row["idEmprestimo"] . "</th>";
                    echo "<td>" . $row["nome_leitor"] . "</td>";
                    echo "<td>" . $row["titulo_livro"] . "</td>";
                    echo "<td>" . $row["data_emprestimo"] . "</td>";
                    echo "<td>" . $row["data_devolucao"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum empréstimo encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">TÍTULO DO LIVRO</th>
            <th scope="col">QUANTIDADE DISPONÍVEL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Consulta SQL para buscar todos os livros e suas quantidades disponíveis
        $sqlLivros = "SELECT idLivro, titulo, num_copias FROM livros";
        $resultLivros = $conn->query($sqlLivros);

        if ($resultLivros->num_rows > 0) {
            while ($row = $resultLivros->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . $row["idLivro"] . "</th>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["num_copias"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum livro cadastrado.</td></tr>";
        }
        ?>
    </tbody>
    </table>

    <?php
    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
