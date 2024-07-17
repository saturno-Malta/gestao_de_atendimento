<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idTipoAtendimento = $_GET['id'];

$conn = getConnection();
$stmt = $conn->prepare("SELECT nomeTipoAtendimento FROM tipoatendimento WHERE idTipoAtendimento = ? AND ativo = 'S'");
$stmt->bind_param('i', $idTipoAtendimento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Tipo de Atendimento não encontrado.";
    $stmt->close();
    $conn->close();
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeTipoAtendimento = $_POST['nomeTipoAtendimento'];

    $stmt = $conn->prepare("UPDATE tipoatendimento SET nomeTipoAtendimento = ? WHERE idTipoAtendimento = ?");
    $stmt->bind_param('si', $nomeTipoAtendimento, $idTipoAtendimento);

    if ($stmt->execute()) {
        echo "Tipo de Atendimento atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar Tipo de Atendimento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Atendimento</title>
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
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
        <h2>Editar Tipo de Atendimento</h2>
        <form action="" method="post">
            <label for="nomeTipoAtendimento">Nome do Tipo de Atendimento:</label>
            <input type="text" id="nomeTipoAtendimento" name="nomeTipoAtendimento" value="<?php echo htmlspecialchars($row['nomeTipoAtendimento']); ?>" required>
            <br>
            <input type="submit" value="Atualizar">
        </form>
        <a href="gerenciar_tipos_atendimento.php">Voltar</a>
    </div>
</body>
</html>
