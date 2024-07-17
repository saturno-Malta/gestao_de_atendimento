<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

$sql = "SELECT u.idUsuario, u.nomeUsuario, u.emailUsuario, u.loginUsuario, u.ativo, p.nomePerfil FROM usuario u JOIN perfil p ON u.idPerfil = p.idPerfil";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #5cabff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        a.button:hover {
            background-color: #3395ff;
        }
        .actions a {
            color: #007BFF;
            text-decoration: none;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Gerenciar Usuários</h2>
        <a href="adicionar_usuario.php" class="button">Adicionar Usuário</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Login</th>
                <th>Ativo</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['idUsuario']; ?></td>
                <td><?php echo $row['nomeUsuario']; ?></td>
                <td><?php echo $row['emailUsuario']; ?></td>
                <td><?php echo $row['loginUsuario']; ?></td>
                <td><?php echo $row['ativo']; ?></td>
                <td><?php echo $row['nomePerfil']; ?></td>
                <td class="actions">
                    <a href="editar_usuario.php?idUsuario=<?php echo $row['idUsuario']; ?>">Editar</a>
                    <a href="excluir_usuario.php?idUsuario=<?php echo $row['idUsuario']; ?>">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
