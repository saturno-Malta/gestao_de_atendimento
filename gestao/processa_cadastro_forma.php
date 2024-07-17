<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

// Obtém a conexão com o banco de dados
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeAtendimento = $_POST['nomeAtendimento']; // Recebe o nome da forma de atendimento do formulário

    // Obtém o id do usuário da sessão
    $idUsuario = $_SESSION['idUsuario'];

    // Prepare a consulta SQL para inserir os dados
    $sql = "INSERT INTO formaatendimento (idUsuario, nomeAtendimento, dataCadastro, ativo) VALUES (?, ?, NOW(), 'S')";

    // Verifica se a consulta foi preparada corretamente
    if ($stmt = $conn->prepare($sql)) {
        // Faz a vinculação dos parâmetros
        $stmt->bind_param("iss", $idUsuario, $nomeAtendimento);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Forma de atendimento cadastrada com sucesso!";
            // Redireciona para uma página de sucesso ou realiza outra ação necessária
            header("Location: listar_formas.php");
            exit();
        } else {
            echo "Erro ao cadastrar forma de atendimento: " . $stmt->error;
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

