<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idPublico = $_GET['id'];

$conn = getConnection();
$stmt = $conn->prepare("DELETE FROM publico WHERE idPublico = ? AND ativo = 'S'");
$stmt->bind_param('i', $idPublico);

if ($stmt->execute()) {
    echo "Público excluído com sucesso!";
} else {
    echo "Erro ao excluir público: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Público</title>
</head>
<body>
    <h2>Excluir Público</h2>
    <a href="gerenciar_publico.php">Voltar</a>
</body>
</html>
