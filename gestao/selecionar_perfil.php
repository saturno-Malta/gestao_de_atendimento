<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['forma_atendimento'])) {
    header("Location: login_unificado.php");
    exit();
}

// Verifica se o perfil de atendimento foi selecionado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['perfil_atendimento'])) {
        $_SESSION['perfil_atendimento'] = $_POST['perfil_atendimento'];
        
        // Mensagem de depuração
        error_log("Perfil de atendimento selecionado: " . $_SESSION['perfil_atendimento']);
        
        header("Location: selecionar_tipo_atendimento.php");
        exit();
    } else {
        echo "Perfil de atendimento não selecionado.";
    }
}

$conn = getConnection();

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

$sql = "SELECT idPerfil, nomePerfil FROM perfil WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Perfil da Pessoa Atendida</title>
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
        <h2>Selecionar Perfil de Atendimento</h2>
        <?php if ($result->num_rows > 0) : ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="perfil_atendimento">Perfil de Atendimento:</label>
                <select id="perfil_atendimento" name="perfil_atendimento" required>
                    <option value="">Selecione...</option>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <option value="<?php echo htmlspecialchars($row['idPerfil']); ?>">
                            <?php echo htmlspecialchars($row['nomePerfil']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br><br>
                <button type="submit">Confirmar</button>
            </form>
        <?php else : ?>
            <p>Nenhum perfil de atendimento encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
