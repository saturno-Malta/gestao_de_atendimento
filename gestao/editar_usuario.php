<?php
session_start();

// Verifica se o usuário está autenticado e se ele é um administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['perfil'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'getConnection.php';

$conn = getConnection();

// Obtém os perfis de acesso
$sql = "SELECT idPerfil, nomePerfil FROM perfil";
$perfisResult = $conn->query($sql);

// Obtém os dados do usuário a ser editado
$idUsuario = $_GET['idUsuario'];
$sql = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUsuario = $_POST['nomeUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $loginUsuario = $_POST['loginUsuario'];
    $telefoneCelular = $_POST['telefoneCelular'];
    $ativo = $_POST['ativo'];
    $idPerfil = $_POST['idPerfil'];

    $sql = "UPDATE usuario SET nomeUsuario='$nomeUsuario', emailUsuario='$emailUsuario', loginUsuario='$loginUsuario', telefoneCelular='$telefoneCelular', ativo='$ativo', idPerfil='$idPerfil' WHERE idUsuario=$idUsuario";

    if ($conn->query($sql) === TRUE) {
        header("Location: gerenciar_usuarios.php");
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
    <title>Editar Usuário</title>
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
            margin-top: 10px;
        }
        input, select {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #5cabff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4aa8ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?idUsuario=$idUsuario"; ?>" method="post">
            <label for="nomeUsuario">Nome:</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario" value="<?php echo $usuario['nomeUsuario']; ?>" required>

            <label for="emailUsuario">Email:</label>
            <input type="email" id="emailUsuario" name="emailUsuario" value="<?php echo $usuario['emailUsuario']; ?>" required>

            <label for="loginUsuario">Login:</label>
            <input type="text" id="loginUsuario" name="loginUsuario" value="<?php echo $usuario['loginUsuario']; ?>" required>

            <label for="telefoneCelular">Telefone Celular:</label>
            <input type="text" id="telefoneCelular" name="telefoneCelular" value="<?php echo $usuario['telefoneCelular']; ?>" required>

            <label for="ativo">Ativo:</label>
            <select id="ativo" name="ativo">
                <option value="S" <?php if ($usuario['ativo'] == 'S') echo 'selected'; ?>>Sim</option>
                <option value="N" <?php if ($usuario['ativo'] == 'N') echo 'selected'; ?>>Não</option>
            </select>

            <label for="idPerfil">Perfil de Acesso:</label>
            <select id="idPerfil" name="idPerfil" required>
                <?php while ($row = $perfisResult->fetch_assoc()): ?>
                <option value="<?php echo $row['idPerfil']; ?>" <?php if ($row['idPerfil'] == $usuario['idPerfil']) echo 'selected'; ?>><?php echo $row['nomePerfil']; ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
