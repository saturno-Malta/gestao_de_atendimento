<?php
session_start();

// Verifica se o usuário está autenticado e se é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
require 'getConnection.php';

$conn = getConnection();

// Obtém os perfis de acesso
$sql = "SELECT idPerfil, nomePerfil FROM perfil";
$result = $conn->query($sql);

// Fecha a conexão após obter os perfis
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #5cabff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-start;
        }
        button[type="submit"]:hover {
            background-color: #4a98e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form action="processa_cadastro_usuario.php" method="post">
            <label for="nomeUsuario">Nome:</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario" required>

            <label for="emailUsuario">Email:</label>
            <input type="email" id="emailUsuario" name="emailUsuario" required>

            <label for="loginUsuario">Login:</label>
            <input type="text" id="loginUsuario" name="loginUsuario" required>

            <label for="senhaUsuario">Senha:</label>
            <input type="password" id="senhaUsuario" name="senhaUsuario" required>

            <label for="telefoneCelular">Telefone Celular:</label>
            <input type="tel" id="telefoneCelular" name="telefoneCelular">

            <label for="idPerfil">Perfil:</label>
            <select id="idPerfil" name="idPerfil" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['idPerfil']; ?>"><?php echo $row['nomePerfil']; ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
