<?php
session_start();

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsuario = $_POST['loginUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];

    // Adicione depuração para verificar os dados recebidos
    var_dump($loginUsuario, $senhaUsuario);

    // Obtém a conexão com o banco de dados
    $conn = getConnection();

    // Adicione depuração para verificar a conexão
    if (!$conn) {
        die("Erro na conexão com o banco de dados.");
    }

    // Prepare a consulta SQL para obter o usuário com o login fornecido
    $sql = "SELECT idUsuario, nomeUsuario, senhaUsuario, idPerfil FROM usuario WHERE loginUsuario = ? AND ativo = 'S'";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $loginUsuario);
        $stmt->execute();
        $stmt->bind_result($idUsuario, $nomeUsuario, $hashedSenha, $idPerfil);
        
        if ($stmt->fetch()) {
            // Verifica a senha usando password_verify
            if (password_verify($senhaUsuario, $hashedSenha)) {
                // Armazena as informações do usuário na sessão
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['nomeUsuario'] = $nomeUsuario;
                $_SESSION['perfil'] = $idPerfil == 1 ? 'admin' : 'user'; // Assumindo que idPerfil 1 é admin e 2 é user
                
                // Redireciona para o painel admin ou usuário
                if ($_SESSION['perfil'] == 'admin') {
                    header("Location: painel_admin.php");
                } else {
                    header("Location: painel_usuario.php");
                }
                exit();
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado ou inativo.";
        }
        
        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
</head>
<body>
    <h2>Login Administrativo</h2>
    <form action="processa_login_admin.php" method="post">
        <label for="loginUsuario">Usuário:</label><br>
        <input type="text" id="loginUsuario" name="loginUsuario" required><br><br>
        <label for="senhaUsuario">Senha:</label><br>
        <input type="password" id="senhaUsuario" name="senhaUsuario" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>


