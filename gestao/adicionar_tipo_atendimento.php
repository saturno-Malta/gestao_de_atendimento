<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeTipoAtendimento = $_POST['nomeTipoAtendimento'];
    $dataCadastro = date('Y-m-d H:i:s');
    $ativo = 'S';

    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO tipoatendimento (nomeTipoAtendimento, dataCadastro, ativo) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nomeTipoAtendimento, $dataCadastro, $ativo);

    if ($stmt->execute()) {
        // Redireciona para a página de administração após adicionar com sucesso
        header("Location: painel_admin.php"); // Altere para a página desejada
        exit();
    } else {
        echo "Erro ao adicionar Tipo de Atendimento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tipo de Atendimento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cabff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4a98e0;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #5cabff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Adicionar Tipo de Atendimento</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nomeTipoAtendimento">Nome do Tipo de Atendimento:</label>
            <input type="text" id="nomeTipoAtendimento" name="nomeTipoAtendimento" required>
            <br>
            <input type="submit" value="Adicionar">
        </form>
        <a href="gerenciar_tipos_atendimento.php">Voltar</a>
    </div>
</body>
</html>
