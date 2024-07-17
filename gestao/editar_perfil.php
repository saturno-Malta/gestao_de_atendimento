<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

// Obtém os dados do perfil a ser editado
$idPerfil = $_GET['idPerfil'];
$sql = "SELECT * FROM perfil WHERE idPerfil = $idPerfil";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $perfil = $result->fetch_assoc();
} else {
    echo "Perfil não encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomePerfil = $_POST['nomePerfil'];

    $sql = "UPDATE perfil SET nomePerfil='$nomePerfil' WHERE idPerfil=$idPerfil";

    if ($conn->query($sql) === TRUE) {
        header("Location: gerenciar_perfis.php");
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
    <title>Editar Perfil</title>
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
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            text-align: left;
        }
        input[type="text"] {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #5cabff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4da6ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Perfil</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?idPerfil=$idPerfil"; ?>" method="post">
            <label for="nomePerfil">Nome do Perfil:</label>
            <input type="text" id="nomePerfil" name="nomePerfil" value="<?php echo $perfil['nomePerfil']; ?>" required>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
