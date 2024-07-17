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

// Prepara a consulta SQL para selecionar todas as formas de atendimento
$sql = "SELECT idFormaAtendimento, nomeAtendimento, dataCadastro, ativo FROM formaatendimento";

// Executa a consulta
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Formas de Atendimento</title>
</head>
<body>
    <h2>Listar Formas de Atendimento</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome da Forma de Atendimento</th>
            <th>Data de Cadastro</th>
            <th>Ativo</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Saída de dados de cada linha
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["idFormaAtendimento"]. "</td>
                        <td>" . $row["nomeAtendimento"]. "</td>
                        <td>" . $row["dataCadastro"]. "</td>
                        <td>" . $row["ativo"]. "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhuma forma de atendimento encontrada</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br>
    <a href="adicionar_forma_atendimento.php">Adicionar Nova Forma de Atendimento</a>
    <a href="gerenciar_formas_atendimento.php">Excluir uma Forma de Atendimento</a>
</body>
</html>

