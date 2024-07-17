<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Cadastro de Usuário</h2>
        <form action="processa_cadastro_usuario_admin.php" method="post">
            <label for="nomeUsuario">Nome:</label><br>
            <input type="text" id="nomeUsuario" name="nomeUsuario" required><br><br>

            <label for="emailUsuario">Email:</label><br>
            <input type="email" id="emailUsuario" name="emailUsuario" required><br><br>

            <label for="loginUsuario">Login:</label><br>
            <input type="text" id="loginUsuario" name="loginUsuario" required><br><br>

            <label for="senhaUsuario">Senha:</label><br>
            <input type="password" id="senhaUsuario" name="senhaUsuario" required><br><br>

            <label for="telefoneCelular">Telefone Celular:</label><br>
            <input type="text" id="telefoneCelular" name="telefoneCelular"><br><br>

            <label for="perfil">Perfil:</label><br>
            <select id="perfil" name="perfil" required>
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select><br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
