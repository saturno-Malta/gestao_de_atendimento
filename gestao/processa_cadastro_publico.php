<?php
session_start();

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomePublico = $_POST['nomePublico'];
    $idUsuario = $_SESSION['idUsuario']; // Obtém o ID do usuário da sessão
    $dataCadastro = date('Y-m-d H:i:s');
    $ativo = 'S';

    // Prepare a consulta SQL
    $sql = "INSERT INTO publico (idUsuario, nomePublico, dataCadastro, ativo)
            VALUES (?, ?, ?, ?)";

    // Obtém a conexão com o banco de dados
    $conn = getConnection();

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $idUsuario, $nomePublico, $dataCadastro, $ativo);
        if ($stmt->execute()) {
            echo "Público cadastrado com sucesso!";
            // Redireciona para uma página de sucesso ou para o gerenciamento de públicos
            header("Location: gerenciar_publico.php"); 
            exit();
        } else {
            echo "Erro ao cadastrar público: " . $stmt->error;
        }
    } else {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
