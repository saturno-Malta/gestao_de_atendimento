// cadastro_tipoatendimento.php

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tipo de Atendimento</title>
</head>
<body>
    <h2>Cadastro de Tipo de Atendimento</h2>
    <form action="processa_cadastro_tipoatendimento.php" method="post">
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
