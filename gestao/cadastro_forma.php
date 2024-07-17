<?php
session_start();

// Verifica se o usuário está logado e tem o perfil de Administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['idPerfil'] != 1) {
    header("Location: login.php");
    exit();
}

// Resto do código para o cadastro de forma de atendimento...
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Forma de Atendimento</title>
</head>
<body>
    <h2>Cadastro de Forma de Atendimento</h2>
    <form action="processa_cadastro_forma.php" method="post">
        <label for="nomeAtendimento">Nome da Forma de Atendimento:</label><br>
        <input type="text" id="nomeAtendimento" name="nomeAtendimento" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>


