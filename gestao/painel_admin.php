<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['perfil_acesso'] != 'admin') {
    header("Location: login_unificado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #2da0ff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
        .logout:hover {
            background-color: #2da0ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Painel do Administrador</h2>
        <ul>
            <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
            <li><a href="gerenciar_perfis.php">Gerenciar Perfis de Acesso</a></li>
            <li><a href="gerenciar_formas_atendimento.php">Gerenciar Formas de Atendimento</a></li>
            <li><a href="gerenciar_publico.php">Gerenciar Público</a></li>
            <li><a href="gerenciar_tipos_atendimento.php">Gerenciar Tipos de Atendimento</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
