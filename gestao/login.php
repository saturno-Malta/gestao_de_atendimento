<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container label, .login-container input {
            display: block;
            margin-bottom: 10px;
        }
        .login-container input[type="text"], .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
        .login-container p {
            margin-top: 10px;
            text-align: center;
        }
        .login-container a {
            color: #4CAF50;
            text-decoration: none;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="processa_login.php" method="post">
            <label for="loginUsuario">Login:</label>
            <input type="text" id="loginUsuario" name="loginUsuario" required>
            <label for="senhaUsuario">Senha:</label>
            <input type="password" id="senhaUsuario" name="senhaUsuario" required>
            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro_usuario.php">Cadastre-se</a></p>
    </div>
</body>
</html>






