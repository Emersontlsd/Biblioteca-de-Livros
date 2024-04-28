<!DOCTYPE html>
<html>
<head>
    <title>EMPRÉSTIMO DE LIVRO</title>
</head>
<body>
    <h1>Empréstimo de Livro</h1>
    <form action="processar_emprestimo.php" method="POST">
        <label for="id_cliente">Selecione o cliente:</label>
        <select id="id_cliente" name="id_cliente" required>
        
        <?php
           
           include_once('config.php');

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta para buscar os clientes cadastrados
            $sqlClientes = "SELECT idleitor, nome FROM leitor";
            $resultClientes = $conn->query($sqlClientes);

            // Exibe os clientes como opções no menu suspenso
            if ($resultClientes->num_rows > 0) {
                while($rowCliente = $resultClientes->fetch_assoc()) {
                    echo "<option value='" . $rowCliente["idleitor"] . "'>" . $rowCliente["nome"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum cliente encontrado</option>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        ?>

        </select><br><br>
        <label for="idlivro">Selecione o livro:</label>
        <select id="idlivro" name="idlivro" required>
        <?php
            include_once("config.php");

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta para buscar os livros disponíveis
            $sqlLivros = "SELECT idlivro, titulo FROM livros WHERE num_copias > 0";
            $resultLivros = $conn->query($sqlLivros);

            // Exibe os livros disponíveis como opções no menu suspenso
            if ($resultLivros->num_rows > 0) {
                while($rowLivro = $resultLivros->fetch_assoc()) {
                    echo "<option value='" . $rowLivro["idlivro"] . "'>" . $rowLivro["titulo"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum livro disponível</option>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        ?>
        </select><br><br>
        <input type="submit" value="Emprestar">
    </form>
</body>
</html>