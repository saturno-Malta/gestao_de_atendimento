<?php
session_start();
require 'getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsuario = $_POST['loginUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];

    $conn = getConnection();

    if (!$conn) {
        die("Erro na conexão com o banco de dados.");
    }

    $sql = "SELECT idUsuario, nomeUsuario, senhaUsuario, idPerfil FROM usuario WHERE loginUsuario = ? AND ativo = 'S'";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $loginUsuario);
        $stmt->execute();
        $stmt->bind_result($idUsuario, $nomeUsuario, $hashedSenha, $idPerfil);
        
        if ($stmt->fetch()) {
            if (password_verify($senhaUsuario, $hashedSenha)) {
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['nomeUsuario'] = $nomeUsuario;
                $_SESSION['perfil'] = $idPerfil == 1 ? 'admin' : 'user'; // Assumindo que idPerfil 1 é admin e 2 é user
                
                if ($_SESSION['perfil'] == 'admin') {
                    header("Location: painel_admin.php");
                } else {
                    header("Location: dashboard.php"); // Redireciona para o painel do usuário padrão
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
