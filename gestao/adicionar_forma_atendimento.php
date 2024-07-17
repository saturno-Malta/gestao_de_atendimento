<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Inclua o arquivo de conexão com o banco de dados
require 'getConnection.php';

// Inicializa variáveis para armazenar mensagens de sucesso e erro
$successMsg = "";
$errorMsg = "";

// Processa o formulário quando ele é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeAtendimento'])) {
        $nomeAtendimento = $_POST['nomeAtendimento']; // Recebe o nome da forma de atendimento do formulário
    } else {
        $nomeAtendimento = '';
    }

    // Obtém o id do usuário da sessão
    $idUsuario = $_SESSION['idUsuario'];

    // Obtém a conexão com o banco de dados
    $conn = getConnection();

    // Prepare a consulta SQL para inserir os dados
    $sql = "INSERT INTO formaatendimento (idUsuario, nomeAtendimento, dataCadastro, ativo) VALUES (?, ?, NOW(), 'S')";

    // Verifica se a consulta foi preparada corretamente
    if ($stmt = $conn->prepare($sql)) {
        // Faz a vinculação dos parâmetros
        $stmt->bind_param("is", $idUsuario, $nomeAtendimento);

        // Executa a consulta
        if ($stmt->execute()) {
            $successMsg = "Forma de atendimento cadastrada com sucesso!";
        } else {
            $errorMsg = "Erro ao cadastrar forma de atendimento: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $errorMsg = "Erro ao preparar a declaração: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Forma de Atendimento</title>
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
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
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
        a {
            color: #5cabff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Adicionar Forma de Atendimento</h2>
        <?php
        if ($successMsg) {
            echo "<div class='message success'>$successMsg</div>";
        }
        if ($errorMsg) {
            echo "<div class='message error'>$errorMsg</div>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nomeAtendimento">Nome da Forma de Atendimento:</label><br>
            <input type="text" id="nomeAtendimento" name="nomeAtendimento" required><br>
            <button type="submit">Adicionar</button>
        </form>
        <a href="gerenciar_formas_atendimento.php">Voltar</a>
    </div>
</body>
</html>
