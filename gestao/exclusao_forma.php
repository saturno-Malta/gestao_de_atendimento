<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Forma de Atendimento</title>
</head>
<body>
    <h2>Exclusão de Forma de Atendimento</h2>
    <form action="processa_exclusao_forma.php" method="POST">
        <input type="hidden" name="idFormaAtendimento" value="<?php echo $idFormaAtendimento; ?>">
        <p>Você tem certeza que deseja excluir esta forma de atendimento?</p>
        <button type="submit">Confirmar Exclusão</button>
        <a href="listar_formas.php">Cancelar</a>
    </form>
</body>
</html>
