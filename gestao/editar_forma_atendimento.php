<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

// Obtém os dados da forma de atendimento a ser editada
$idForma = $_GET['idForma'];
$sql = "SELECT * FROM formaatendimento WHERE idForma = $idForma";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $forma = $result->fetch_assoc();
} else {
    echo "Forma de atendimento não encontrada.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeForma = $_POST['nomeForma'];

    $sql = "UPDATE formaatendimento SET nomeForma='$nomeForma' WHERE idForma=$idForma";

    if ($conn->query($sql) === TRUE) {
        header("Location: gerenciar_formas_atendimento.php");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Forma de Atendimento</title>
</head>
<body>
    <h2>Editar Forma de Atendimento</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?idForma=$idForma"; ?>" method="post">
        <label for="nomeForma">Nome da Forma:</label>
        <input type="text" id="nomeForma" name="nomeForma" value="<?php echo $forma['nomeForma']; ?>" required><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
