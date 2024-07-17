<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

$idPerfil = $_GET['idPerfil'];

// Verifica se há usuários vinculados a este perfil
$sql_check_users = "SELECT COUNT(*) AS num_users FROM usuario WHERE idPerfil = $idPerfil";
$result_check_users = $conn->query($sql_check_users);

if ($result_check_users) {
    $row = $result_check_users->fetch_assoc();
    $num_users = $row['num_users'];

    if ($num_users > 0) {
        // Exclua os usuários vinculados a este perfil primeiro
        $sql_delete_users = "DELETE FROM usuario WHERE idPerfil = $idPerfil";
        if ($conn->query($sql_delete_users) === TRUE) {
            // Após excluir os usuários, exclua o perfil
            $sql_delete_perfil = "DELETE FROM perfil WHERE idPerfil = $idPerfil";
            if ($conn->query($sql_delete_perfil) === TRUE) {
                header("Location: gerenciar_perfis.php");
                exit();
            } else {
                echo "Erro ao excluir perfil: " . $conn->error;
            }
        } else {
            echo "Erro ao excluir usuários vinculados ao perfil: " . $conn->error;
        }
    } else {
        // Se não houver usuários vinculados, exclua o perfil diretamente
        $sql_delete_perfil = "DELETE FROM perfil WHERE idPerfil = $idPerfil";
        if ($conn->query($sql_delete_perfil) === TRUE) {
            header("Location: gerenciar_perfis.php");
            exit();
        } else {
            echo "Erro ao excluir perfil: " . $conn->error;
        }
    }
} else {
    echo "Erro ao verificar usuários vinculados ao perfil: " . $conn->error;
}

$conn->close();
?>
