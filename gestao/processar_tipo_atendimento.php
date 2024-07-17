<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Receber e processar o tipo de atendimento confirmado (supondo que vem de um formulário POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoAtendimentoConfirmado = $_POST['tipo_atendimento'];

    // Atualizar a variável de sessão
    $_SESSION['tipoAtendimento'] = $tipoAtendimentoConfirmado;

    // Redirecionar para o dashboard ou próxima etapa
    header("Location: dashboard.php");
    exit();
} else {
    // Redirecionar para uma página de erro se o método não for POST
    header("Location: erro.php");
    exit();
}
?>

<!-- Formulário para seleção e confirmação do tipo de atendimento -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Seleção de Tipo de Atendimento</title>
</head>
<body>
    <h2>Selecionar Tipo de Atendimento</h2>
    <form action="processa_tipo_atendimento.php" method="post">
        <label for="tipo_atendimento">Selecione o Tipo de Atendimento:</label>
        <select name="tipo_atendimento" id="tipo_atendimento">
            <option value="atendimento1">Atendimento 1</option>
            <option value="atendimento2">Atendimento 2</option>
            <option value="atendimento3">Atendimento 3</option>
            <!-- Adicione outras opções conforme necessário -->
        </select>
        <button type="submit">Confirmar Tipo de Atendimento</button>
    </form>
</body>
</html>

