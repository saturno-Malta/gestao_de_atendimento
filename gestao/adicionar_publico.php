<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomePublico = $_POST['nomePublico'];
    $idUsuario = $_SESSION['idUsuario'];
    $dataCadastro = date('Y-m-d H:i:s');
    $ativo = 'S';

    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO publico (idUsuario, nomePublico, dataCadastro, ativo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $idUsuario, $nomePublico, $dataCadastro, $ativo);

    if ($stmt->execute()) {
        echo "Público adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar público: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Público</title>
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
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #5cabff;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover {
            background-color: #4da6ff;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #5cabff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Adicionar Público</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nomePublico">Nome do Público:</label>
            <input type="text" id="nomePublico" name="nomePublico" required>
            <br>
            <input type="submit" value="Adicionar">
        </form>
        <a href="gerenciar_publico.php">Voltar</a>
    </div>
</body>
</html>
