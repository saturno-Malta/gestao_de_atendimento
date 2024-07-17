<?php
session_start();

// Verifica se o usuário está autenticado, se não, redireciona para a página de login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o perfil foi selecionado
if (!isset($_SESSION['perfil'])) {
    header("Location: selecionar_perfil.php");
    exit();
}

$perfil = $_SESSION['perfil'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perguntas Específicas do Perfil</title>
</head>
<body>
    <h2>Perguntas Específicas do Perfil</h2>
    <form action="informar_tipo_atendimento.php" method="post">
        <?php if ($perfil == '1') : ?>
            <label for="nomeEmpregador">Nome do Empregador:</label>
            <input type="text" id="nomeEmpregador" name="nomeEmpregador" required><br>

            <label for="cnpj">CNPJ:</label>
            <input type="text" id="cnpj" name="cnpj" required><br>

            <label for="telefoneContato">Telefone para Contato:</label>
            <input type="text" id="telefoneContato" name="telefoneContato" required><br>
        <?php elseif ($perfil == '2') : ?>
            <label for="nomeTrabalhador">Nome do Trabalhador:</label>
            <input type="text" id="nomeTrabalhador" name="nomeTrabalhador" required><br>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required><br>

            <label for="telefoneContato">Telefone para Contato:</label>
            <input type="text" id="telefoneContato" name="telefoneContato" required><br>
        <?php endif; ?>
        <!-- Adicione outras perguntas conforme necessário -->

        <button type="submit">Próximo</button>
    </form>
</body>
</html>
