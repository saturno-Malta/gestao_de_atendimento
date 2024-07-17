<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idPublico = $_GET['id'];

$conn = getConnection();
$stmt = $conn->prepare("SELECT nomePublico FROM publico WHERE idPublico = ? AND ativo = 'S'");
$stmt->bind_param('i', $idPublico);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Público não encontrado.";
    $stmt->close();
    $conn->close();
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomePublico = $_POST['nomePublico'];

    $stmt = $conn->prepare("UPDATE publico SET nomePublico = ? WHERE idPublico = ?");
    $stmt->bind_param('si', $nomePublico, $idPublico);

    if ($stmt->execute()) {
        echo "Público atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar público: " . $stmt->error;
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
    <title>Editar Público</title>
</head>
<body>
    <h2>Editar Público</h2>
    <form action="" method="post">
        <label for="nomePublico">Nome do Público:</label>
        <input type="text" id="nomePublico" name="nomePublico" value="<?php echo htmlspecialchars($row['nomePublico']); ?>" required>
        <br>
        <input type="submit" value="Atualizar">
    </form>
    <a href="gerenciar_publico.php">Voltar</a>
</body>
</html>

