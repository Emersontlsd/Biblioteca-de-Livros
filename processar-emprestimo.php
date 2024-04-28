<?php
// Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o cliente e o livro foram selecionados
    if (!empty($_POST["id_Leitor"]) && !empty($_POST["id_Livro"]) && isset($_POST["data_emprestimo"]) && isset($_POST["data_devolucao"])) {
        // Obtém o ID do cliente e do livro selecionados
        $idLeitor = $_POST["id_Leitor"];
        $idLivro = $_POST["id_Livro"];
        $data_emprestimo = $_POST["data_emprestimo"];
        $data_devolucao = $_POST["data_devolucao"];

        // Incluir o arquivo de configuração do banco de dados
        include_once("config.php");

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Formata a data do empréstimo para o formato correto (string entre aspas simples)
        $data_emprestimo_formatada = date('Y-m-d', strtotime($data_emprestimo));
        $data_devolucao_formatada = date('Y-m-d', strtotime($data_devolucao));

        // Verifica se o livro está disponível na biblioteca
        $sqlVerificaDisponibilidade = "SELECT num_copias FROM Livros WHERE idLivro = $idLivro";
        $resultVerificaDisponibilidade = $conn->query($sqlVerificaDisponibilidade);

        if ($resultVerificaDisponibilidade->num_rows > 0) {
            $row = $resultVerificaDisponibilidade->fetch_assoc();
            $num_copias = $row["num_copias"];

            // Verifica se há pelo menos uma cópia disponível para empréstimo
            if ($num_copias > 0) {
                // Insere o empréstimo na tabela de empréstimos
                
                $sqlInsereEmprestimo = "INSERT INTO emprestimo (idLeitor, idLivro, data_emprestimo, data_devolucao) VALUES ('$idLeitor', '$idLivro', '$data_emprestimo_formatada', '$data_devolucao_formatada')";
                if ($conn->query($sqlInsereEmprestimo) === TRUE) {
                    // Atualiza a quantidade disponível do livro na biblioteca
                    $nova_quantidade = $num_copias - 1;
                    $sqlAtualizaQuantidade = "UPDATE livros SET num_copias = $nova_quantidade WHERE idLivro = $idLivro";
                    if ($conn->query($sqlAtualizaQuantidade) === TRUE) {
                        
                        echo "<script>alert('Empréstimo realizado com sucesso!'); window.location.href = 'index.php';</script>";
                        
                    } else {
                        echo "Erro ao atualizar a quantidade disponível do livro: " . $conn->error;
                    }
                } else {
                    echo "<script>alert('Erro ao realizar o empréstimo:');</script> " . $conn->error;
                }
            } else {
                echo "<script>alert('Não há cópias disponíveis deste livro para empréstimo.');</script>";
            }
        } else {
            echo "<script>alert('Livro não encontrado na biblioteca.');</script>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "<script>alert('Por favor, selecione um cliente e um livro para realizar o empréstimo.');</script>";
    }
} else {
    echo "<script>alert('O formulário não foi enviado corretamente.');</script>";
}
?>