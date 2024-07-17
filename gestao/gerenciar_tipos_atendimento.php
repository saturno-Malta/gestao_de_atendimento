<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$conn = getConnection();
$sql = "SELECT idTipoAtendimento, nomeTipoAtendimento FROM tipoatendimento WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result === false) {
    echo "Erro ao executar a consulta: " . $conn->error;
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Tipos de Atendimento</title>
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
            width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        td a {
            text-decoration: none;
            margin-right: 10px;
        }
        a {
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
        <h2>Gerenciar Tipos de Atendimento</h2>
        <a href="adicionar_tipo_atendimento.php">Adicionar Tipo de Atendimento</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['idTipoAtendimento']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nomeTipoAtendimento']) . "</td>";
                    echo "<td>";
                    echo "<a href='editar_tipo_atendimento.php?id=" . urlencode($row['idTipoAtendimento']) . "'>Editar</a> ";
                    echo "<a href='excluir_tipo_atendimento.php?id=" . urlencode($row['idTipoAtendimento']) . "'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
