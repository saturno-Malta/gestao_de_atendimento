<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Formas de Atendimento</title>
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
            width: 800px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #5cabff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background-color: #4da6ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Gerenciar Formas de Atendimento</h2>
        <a href="adicionar_forma_atendimento.php" class="button">Adicionar Forma de Atendimento</a>
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
                // Exemplo de conexão ao banco de dados (substitua pelos seus dados)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gestaoatendimentos";

                // Conexão com o banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Consulta SQL para obter formas de atendimento
                $sql = "SELECT idFormaAtendimento, nomeAtendimento FROM formaatendimento WHERE ativo = 'S'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Exibir os resultados encontrados
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idFormaAtendimento'] . "</td>";
                        echo "<td>" . $row['nomeAtendimento'] . "</td>";
                        echo "<td>";
                        echo "<a href='editar_forma_atendimento.php?id=" . $row['idFormaAtendimento'] . "'>Editar</a>";
                        echo " | ";
                        echo "<a href='excluir_forma_atendimento.php?id=" . $row['idFormaAtendimento'] . "'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhuma forma de atendimento encontrada.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
