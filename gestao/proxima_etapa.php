<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formaAtendimento = $_POST['formaAtendimento'];
    
    // Armazena a forma de atendimento na sessão
    $_SESSION['formaAtendimento'] = $formaAtendimento;

    // Redireciona para a próxima página
    header("Location: selecionar_perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redirecionando...</title>
</head>
<body>
    <p>Redirecionando para a próxima etapa...</p>
</body>
</html>
