<?php
session_start();

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUsuario = $_POST['nomeUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $loginUsuario = $_POST['loginUsuario'];
    $senhaUsuario = password_hash($_POST['senhaUsuario'], PASSWORD_DEFAULT); // Usa hashing para a senha
    $telefoneCelular = $_POST['telefoneCelular'];
    $perfil = $_POST['perfil']; // Recebe o perfil do formulário
    $dataCadastro = date('Y-m-d H:i:s');
    $ativo = 'S';

    // Mapeia o perfil para idPerfil correspondente
    $idPerfil = ($perfil == 'admin') ? 1 : 2;

    // Obtém a conexão com o banco de dados
    $conn = getConnection();

    // Prepare a consulta SQL
    $sql = "INSERT INTO usuario (nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, dataCadastro, telefoneCelular, ativo, idPerfil)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssi", $nomeUsuario, $emailUsuario, $loginUsuario, $senhaUsuario, $dataCadastro, $telefoneCelular, $ativo, $idPerfil);
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
            // Redireciona para uma página de sucesso ou painel admin
            header("Location: painel_admin.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>



