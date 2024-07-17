<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoAtendimento = $_POST['tipoAtendimento'];

    // Verifica se o tipo de atendimento foi selecionado
    if (empty($tipoAtendimento)) {
        echo "Por favor, selecione um tipo de atendimento.";
        exit();
    }

    // Salva o tipo de atendimento na sessão (opcional, dependendo da lógica do sistema)
    $_SESSION['tipoAtendimento'] = $tipoAtendimento;

    // Redireciona para a tela de login com mensagem de sucesso
    echo "<script>
        alert('Tipo de atendimento informado com sucesso!');
        window.location.href = 'login.php';
    </script>";
    exit();
} else {
    echo "Acesso inválido a esta página.";
    exit();
}
?>
