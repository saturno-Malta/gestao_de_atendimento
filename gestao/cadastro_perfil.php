<?php
// cadastro_perfil.php

// Incluir o arquivo de conexão
include_once('getConnection.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nomePerfil = $_POST['perfil'] ?? '';

    // Validar se o campo 'perfil' foi preenchido
    if (empty($nomePerfil)) {
        die("Por favor, preencha o campo 'Perfil'.");
    }

    // Estabelecer conexão com o banco de dados
    $conn = getConnection();

    // Verificar a conexão
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO perfil (nomePerfil, dataCadastro, ativo) VALUES (?, NOW(), 'S')");

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    // Bind dos parâmetros e execução da consulta
    $stmt->bind_param("s", $nomePerfil);

    if ($stmt->execute()) {
        echo "Perfil cadastrado com sucesso!";
        // Exemplo de redirecionamento após 2 segundos
        header("refresh:2;url=dashboard.php");
        exit();
    } else {
        echo "Erro ao cadastrar perfil: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>

<!-- Formulário HTML para cadastro de perfil -->
<form action="cadastro_perfil.php" method="post">
    <label for="perfil">Perfil:</label>
    <input type="text" id="perfil" name="perfil" required>
    <button type="submit">Cadastrar</button>
</form>
