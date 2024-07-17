<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login_unificado.php");
    exit();
}

// Verifica se a forma de atendimento foi selecionada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['formaAtendimento'])) {
        $_SESSION['forma_atendimento'] = $_POST['formaAtendimento'];
        
        // Mensagem de depuração
        error_log("Forma de atendimento selecionada: " . $_SESSION['forma_atendimento']);
        
        header("Location: selecionar_perfil.php");
        exit();
    } else {
        echo "Forma de atendimento não selecionada.";
    }
}

$conn = getConnection();

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

$sql = "SELECT idFormaAtendimento, nomeAtendimento FROM formaatendimento WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Forma de Atendimento</title>
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
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
        }
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #5cabff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-start;
        }
        button[type="submit"]:hover {
            background-color: #4a98e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selecionar Forma de Atendimento</h2>
        <?php if ($result->num_rows > 0) : ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="formaAtendimento">Forma de Atendimento:</label>
                <select id="formaAtendimento" name="formaAtendimento" required>
                    <option value="">Selecione...</option>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <option value="<?php echo htmlspecialchars($row['idFormaAtendimento']); ?>">
                            <?php echo htmlspecialchars($row['nomeAtendimento']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br>
                <button type="submit">Confirmar</button>
            </form>
        <?php else : ?>
            <p>Nenhuma forma de atendimento encontrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>


