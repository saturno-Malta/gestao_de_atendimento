<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login_unificado.php");
    exit();
}

// Verifica se as perguntas específicas foram respondidas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva as respostas das perguntas específicas na sessão
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }

    // Adicione uma mensagem de depuração
    error_log("Tipo de atendimento informado: " . $_POST['tipoAtendimento']);
    
    header("Location: finalizar_atendimento.php"); // Ajuste para redirecionar para a próxima etapa
    exit();
}

$conn = getConnection();
$sql = "SELECT idTipoAtendimento, nomeTipoAtendimento FROM tipoatendimento WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Informar Tipo de Atendimento</h2>";
    echo "<form action='informar_tipo_atendimento.php' method='post'>";
    echo "<label for='tipoAtendimento'>Tipo de Atendimento:</label><br>";
    echo "<select id='tipoAtendimento' name='tipoAtendimento' required>";
    echo "<option value=''>Selecione...</option>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['idTipoAtendimento'] . "'>" . $row['nomeTipoAtendimento'] . "</option>";
    }
    
    echo "</select><br><br>";
    echo "<button type='submit'>Confirmar</button>";
    echo "</form>";
} else {
    echo "Nenhum tipo de atendimento encontrado.";
}

$conn->close();
?>


