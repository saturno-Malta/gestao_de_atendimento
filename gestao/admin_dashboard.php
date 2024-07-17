<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
</head>
<body>
    <h2>Painel de Administração</h2>
    <ul>
        <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
        <li><a href="gerenciar_perfis.php">Gerenciar Perfis de Acesso</a></li>
        <li><a href="gerenciar_formas_atendimento.php">Gerenciar Formas de Atendimento</a></li>
        <li><a href="gerenciar_publico.php">Gerenciar Público</a></li>
        <li><a href="gerenciar_tipos_atendimento.php">Gerenciar Tipos de Atendimento</a></li>
    </ul>
</body>
</html>
