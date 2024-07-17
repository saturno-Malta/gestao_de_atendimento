<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idTipoAtendimento = $_GET['id'];

$conn = getConnection();
$stmt = $conn->prepare("DELETE FROM tipoatendimento WHERE idTipoAtendimento = ? AND ativo = 'S'");
$stmt->bind_param('i', $idTipoAtendimento);

if ($stmt->execute()) {
    echo "Tipo de Atendimento excluído com sucesso!";
} else {
    echo "Erro ao excluir Tipo de Atendimento: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Tipo de Atendimento</title>
</head>
<body>
    <h2>Excluir Tipo de Atendimento</h2>
    <a href="gerenciar_tipos_atendimento.php">Voltar</a>
</body>
</html>

