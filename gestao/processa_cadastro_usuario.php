<?php
session_start();

// Verifica se o usuário está autenticado e se é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
require 'getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUsuario = $_POST['nomeUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $loginUsuario = $_POST['loginUsuario'];
    $senhaUsuario = password_hash($_POST['senhaUsuario'], PASSWORD_BCRYPT);
    $telefoneCelular = $_POST['telefoneCelular'];
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : 'N'; // Valor padrão se não estiver definido
    $idPerfil = $_POST['idPerfil'];

    // Obtém a conexão com o banco de dados
    $conn = getConnection();

    // Verifica se a conexão foi estabelecida corretamente
    if (!$conn) {
        die("Erro na conexão com o banco de dados.");
    }

    // Verifica se o perfil especificado existe na tabela perfil
    $sql_check_profile = "SELECT idPerfil FROM perfil WHERE idPerfil = ?";
    if ($stmt_check_profile = $conn->prepare($sql_check_profile)) {
        $stmt_check_profile->bind_param("i", $idPerfil);
        $stmt_check_profile->execute();
        $stmt_check_profile->store_result();
        
        if ($stmt_check_profile->num_rows == 0) {
            die("O perfil especificado não existe na tabela perfil.");
        }
        
        $stmt_check_profile->close();
    } else {
        die("Erro ao preparar a consulta SQL para verificar o perfil: " . $conn->error);
    }

    // Prepara a consulta SQL para inserir o usuário
    $sql = "INSERT INTO usuario (nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, telefoneCelular, ativo, idPerfil, dataCadastro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    // Prepara e executa a declaração
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $nomeUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $telefoneCelular, $ativo, $idPerfil);
        
        if ($stmt->execute()) {
            // Usuário cadastrado com sucesso
            $_SESSION['mensagem'] = "Usuário cadastrado com sucesso.";
            header("Location: login_unificado.php");
            exit();
        } else {
            // Erro ao cadastrar o usuário
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Erro ao preparar a declaração SQL
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o método da requisição não for POST, redireciona para o login
    header("Location: login.php");
    exit();
}
?>
