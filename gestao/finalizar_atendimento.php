<?php
session_start();
require 'getConnection.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login_unificado.php");
    exit();
}

$formaAtendimento = isset($_SESSION['forma_atendimento']) ? $_SESSION['forma_atendimento'] : 'N/A';
$perfilAtendimento = isset($_SESSION['perfil_atendimento']) ? $_SESSION['perfil_atendimento'] : 'N/A';
$tipoAtendimento = isset($_SESSION['tipo_atendimento']) ? $_SESSION['tipo_atendimento'] : 'N/A';

// Adicione uma mensagem de depuração
error_log("Forma de Atendimento: " . $formaAtendimento);
error_log("Perfil de Atendimento: " . $perfilAtendimento);
error_log("Tipo de Atendimento: " . $tipoAtendimento);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Atendimento</title>
    <script>
        setTimeout(function() {
            window.location.href = 'login_unificado.php';
        }, 5000); // 5000 milissegundos = 5 segundos

        // Para exibir uma mensagem antes do redirecionamento
        document.addEventListener("DOMContentLoaded", function() {
            var messageContainer = document.getElementById("message");
            messageContainer.innerHTML = "<p>Sucesso! Redirecionando em 5 segundos...</p>";
        });
    </script>
</head>
<body>
    <h2>Finalizar Atendimento</h2>
    <div id="message"></div>
    <p>Forma de Atendimento: <?php echo $formaAtendimento; ?></p>
    <p>Perfil: <?php echo $perfilAtendimento; ?></p>
    <p>Tipo de Atendimento: <?php echo $tipoAtendimento; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
