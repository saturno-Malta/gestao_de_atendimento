<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['forma_atendimento']) || !isset($_SESSION['perfil_atendimento'])) {
    header("Location: login_unificado.php");
    exit();
}

// Verifica se o tipo de atendimento foi selecionado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tipo_atendimento'])) {
        $_SESSION['tipo_atendimento'] = $_POST['tipo_atendimento'];
        
        // Mensagem de depuração
        error_log("Tipo de atendimento selecionado: " . $_SESSION['tipo_atendimento']);
        
        header("Location: finalizar_atendimento.php");
        exit();
    } else {
        echo "Tipo de atendimento não selecionado.";
    }
}

$conn = getConnection();
$sql = "SELECT idTipoAtendimento, nomeTipoAtendimento FROM tipoatendimento WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Tipo de Atendimento</title>
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
        <?php if ($result->num_rows > 0) : ?>
            <h2>Selecionar Tipo de Atendimento</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="tipo_atendimento">Tipo de Atendimento:</label>
                <select id="tipo_atendimento" name="tipo_atendimento" required>
                    <option value="">Selecione...</option>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <option value="<?php echo htmlspecialchars($row['idTipoAtendimento']); ?>">
                            <?php echo htmlspecialchars($row['nomeTipoAtendimento']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br><br>
                <button type="submit">Confirmar</button>
            </form>
        <?php else : ?>
            <h2>Nenhum tipo de atendimento encontrado.</h2>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
