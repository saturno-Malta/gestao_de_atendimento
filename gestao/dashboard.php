<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Verificar se o tipo de atendimento foi selecionado e confirmado
if (isset($_SESSION['tipoAtendimento'])) {
    $tipoAtendimento = $_SESSION['tipoAtendimento'];
} else {
    $tipoAtendimento = "N/A";
}

// Verificar se outras variáveis de sessão estão definidas (forma de atendimento, perfil, etc., se aplicável)
// Você pode adaptar esta parte conforme necessário

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Painel do Usuário</h1>
    <h2>Finalizar Atendimento</h2>
    <p>Forma de Atendimento: <?php echo isset($_SESSION['formaAtendimento']) ? $_SESSION['formaAtendimento'] : 'N/A'; ?></p>
    <p>Perfil: <?php echo isset($_SESSION['perfil']) ? $_SESSION['perfil'] : 'N/A'; ?></p>
    <p>Tipo de Atendimento: <?php echo $tipoAtendimento; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
