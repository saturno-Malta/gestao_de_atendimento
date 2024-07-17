<!-- listar_publicos.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Públicos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Listagem de Públicos</h2>
    <?php
    // Incluir o arquivo de conexão
    include_once('getConnection.php');

    // Estabelecer conexão com o banco de dados
    $conn = getConnection();

    // Verificar a conexão
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Preparar a consulta SQL
    $sql = "SELECT idPublico, nomePublico, idUsuario, dataCadastro, ativo FROM publico";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nome do Público</th><th>ID do Usuário</th><th>Data de Cadastro</th><th>Ativo</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["idPublico"]."</td><td>".$row["nomePublico"]."</td><td>".$row["idUsuario"]."</td><td>".$row["dataCadastro"]."</td><td>".$row["ativo"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 resultados";
    }

    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
