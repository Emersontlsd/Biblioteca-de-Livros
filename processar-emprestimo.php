<?php
// Verifica se os dados foram submetidos via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $database = "sua_base_de_dados";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $idCliente = $_POST["id_cliente"];
    $idLivro = $_POST["id_livro"];
    $dataEmprestimo = date("Y-m-d");
    // Defina a data de devolução, por exemplo, 15 dias a partir da data de empréstimo
    $dataDevolucao = date("Y-m-d", strtotime("+15 days"));

    // Verifica se há cópias disponíveis do livro
    $sqlVerificarCopias = "SELECT num_copias_disponiveis FROM livros WHERE id = '$idLivro'";
    $resultVerificarCopias = $conn->query($sqlVerificarCopias);

    if ($resultVerificarCopias && $resultVerificarCopias->num_rows > 0) {
        $row = $resultVerificarCopias->fetch_assoc();
        $numCopiasDisponiveis = $row["num_copias_disponiveis"];

        if ($numCopiasDisponiveis > 0) {
            // Insere os dados na tabela de empréstimos
            $sql = "INSERT INTO emprestimos (id_cliente, id_livro, data_emprestimo, data_devolucao) VALUES ('$idCliente', '$idLivro', '$dataEmprestimo', '$dataDevolucao')";
            $result = $conn->query($sql);

            // Atualiza o número de cópias disponíveis do livro
            $numCopiasAtualizadas = $numCopiasDisponiveis - 1;
            $sqlAtualizarCopias = "UPDATE livros SET num_copias_disponiveis = '$numCopiasAtualizadas' WHERE id = '$idLivro'";
            $resultAtualizarCopias = $conn->query($sqlAtualizarCopias);

            // Verifica se o empréstimo foi realizado com sucesso
            if ($result && $resultAtualizarCopias) {
                echo "Empréstimo realizado com sucesso.";
            } else {
                echo "Erro ao realizar o empréstimo.";
            }
        } else {
            echo "Não há cópias disponíveis deste livro.";
        }
    } else {
        echo "Erro ao verificar as cópias disponíveis do livro.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>