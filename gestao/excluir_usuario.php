<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

$idUsuario = $_GET['idUsuario'];

$sql = "DELETE FROM usuario WHERE idUsuario = $idUsuario";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciar_usuarios.php");
    exit();
} else {
    echo "Erro ao excluir usuário: " . $conn->error;
}

$conn->close();
?>
