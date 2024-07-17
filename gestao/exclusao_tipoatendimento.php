<?php
include_once('getConnection.php');

$conn = getConnection();

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

$idTipoAtendimento = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM tipoatendimento WHERE idTipoAtendimento = ?");

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}

$stmt->bind_param("i", $idTipoAtendimento);

if ($stmt->execute()) {
    echo "Tipo de atendimento excluído com sucesso!";
} else {
    echo "Erro ao excluir tipo de atendimento: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
