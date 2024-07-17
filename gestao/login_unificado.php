<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff; /* Azul claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            width: 100%;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input {
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            background-color: #90d4f4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2da0ff;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 10px;
        }
        img {
            max-width: 100px; /* Ajuste o tamanho conforme necessário */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Adicione o caminho para a sua imagem -->
        <img src="fadergs.png" alt="Logo">
        
        <div class="form-container">
            <h2>Login Administrativo</h2>
            <form action="processa_login_admin.php" method="post">
                <label for="loginUsuario">Login:</label>
                <input type="text" id="loginUsuario" name="loginUsuario" required>
                <label for="senhaUsuario">Senha:</label>
                <input type="password" id="senhaUsuario" name="senhaUsuario" required>
                <button type="submit">Login</button>
            </form>
            <a href="cadastro_usuario_admin.php">Cadastre-se</a>
        </div>
        <div class="form-container">
            <h2>Login Usuário Padrão</h2>
            <form action="processa_login_usuario.php" method="post">
                <label for="loginUsuario">Login:</label>
                <input type="text" id="loginUsuario" name="loginUsuario" required>
                <label for="senhaUsuario">Senha:</label>
                <input type="password" id="senhaUsuario" name="senhaUsuario" required>
                <button type="submit">Login</button>
            </form>
            <a href="cadastro_usuario.php">Cadastre-se</a>
        </div>
    </div>
</body>
</html>


