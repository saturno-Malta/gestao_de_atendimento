<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica se a forma de atendimento e o perfil foram selecionados
if (!isset($_SESSION['formaAtendimento']) || !isset($_SESSION['perfil'])) {
    header("Location: selecionar_perfil.php");
    exit();
}

$perfil = $_SESSION['perfil'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perguntas Específicas</title>
</head>
<body>
    <h2>Responda às Perguntas</h2>
    <form action="selecionar_tipo_atendimento.php" method="post">
        <?php if ($perfil == 'empregador'): ?>
            <label for="nomeEmpregador">Nome do Empregador:</label><br>
            <input type="text" id="nomeEmpregador" name="nomeEmpregador" required><br><br>
            <label for="cnpj">CNPJ:</label><br>
            <input type="text" id="cnpj" name="cnpj" required><br><br>
            <label for="telefoneContato">Telefone para Contato:</label><br>
            <input type="text" id="telefoneContato" name="telefoneContato" required><br><br>
        <?php endif; ?>
        <!-- Adicione mais campos conforme necessário para outros perfis -->
        <button type="submit">Próximo</button>
    </form>
</body>
</html>
