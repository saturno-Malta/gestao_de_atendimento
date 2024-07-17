<?php
include_once('getConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];

    $conn = getConnection();

    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("INSERT INTO tipoatendimento (descricaoTipo, dataCadastro, ativo) VALUES (?, NOW(), 'S')");

    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    $stmt->bind_param("s", $descricao);

    if ($stmt->execute()) {
        echo "Tipo de atendimento cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar tipo de atendimento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
