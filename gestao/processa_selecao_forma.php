<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

// Obtém a conexão com o banco de dados
$conn = getConnection();

// Prepara a consulta SQL para selecionar todas as formas de atendimento ativas
$sql = "SELECT idFormaAtendimento, nomeAtendimento FROM formaatendimento WHERE ativo = 'S'";

// Executa a consulta
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Forma de Atendimento</title>
</head>
<body>
    <h2>Selecionar Forma de Atendimento</h2>
    <form action="processa_selecao_forma.php" method="post">
        <label for="formaAtendimento">Forma de Atendimento:</label><br>
        <select id="formaAtendimento" name="formaAtendimento" required>
            <?php
            if ($result->num_rows > 0) {
                // Saída de dados de cada linha
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["idFormaAtendimento"] . "'>" . $row["nomeAtendimento"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhuma forma de atendimento disponível</option>";
            }
            $conn->close();
            ?>
        </select><br><br>
        <button type="submit">Selecionar</button>
    </form>
</body>
</html>
