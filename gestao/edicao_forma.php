// edicao_forma.php

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Edição de Forma de Atendimento</title>
</head>
<body>
    <h2>Edição de Forma de Atendimento</h2>
    <form action="processa_edicao_forma.php" method="POST">
        <input type="hidden" name="idFormaAtendimento" value="<?php echo $idFormaAtendimento; ?>">
        <label for="nomeAtendimento">Nome da Forma de Atendimento:</label><br>
        <input type="text" id="nomeAtendimento" name="nomeAtendimento" value="<?php echo $nomeAtendimento; ?>" required><br><br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
