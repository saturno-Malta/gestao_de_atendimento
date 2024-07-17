<?php
session_start();
require 'getConnection.php';

// Verifica se o usuário está autenticado, se não, redireciona para a página de login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getConnection();

    $idUsuario = $_SESSION['idUsuario'];
    $nomeAtendimento = $_POST['nomeAtendimento'];
    $dataCadastro = date('Y-m-d H:i:s');
    $ativo = 'S';

    $sql = "INSERT INTO formaatendimento (idUsuario, nomeAtendimento, dataCadastro, ativo)
            VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isss", $idUsuario, $nomeAtendimento, $dataCadastro, $ativo);
        if ($stmt->execute()) {
            echo "Forma de atendimento cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar forma de atendimento: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Forma de Atendimento</title>
</head>
<body>
    <h2>Cadastro de Forma de Atendimento</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nomeAtendimento">Nome do Atendimento:</label><br>
        <input type="text" id="nomeAtendimento" name="nomeAtendimento" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
