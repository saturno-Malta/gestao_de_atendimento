<?php
// Verifica se o ID da forma de atendimento foi fornecido via GET
if (!isset($_GET['id'])) {
    die("ID da forma de atendimento não fornecido.");
}

$idFormaAtendimento = $_GET['id'];

// Exemplo de conexão ao banco de dados (substitua pelos seus dados)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestaoatendimentos";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Prepara a consulta SQL para excluir a forma de atendimento
$sql = "DELETE FROM formaatendimento WHERE idFormaAtendimento = ?";

// Prepara a declaração SQL
if ($stmt = $conn->prepare($sql)) {
    // Liga os parâmetros da consulta
    $stmt->bind_param("i", $idFormaAtendimento);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Forma de atendimento excluída com sucesso.";
    } else {
        echo "Erro ao excluir forma de atendimento: " . $stmt->error;
    }
} else {
    echo "Erro ao preparar a declaração: " . $conn->error;
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>

