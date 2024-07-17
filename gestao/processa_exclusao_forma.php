<?php
include 'getConnection.php';

$conn = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idFormaAtendimento'])) {
    $idFormaAtendimento = $_POST['idFormaAtendimento'];

    // Prepara a query SQL para exclusão
    $sql = "DELETE FROM formaatendimento WHERE idFormaAtendimento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idFormaAtendimento);

    if ($stmt->execute()) {
        echo "Forma de atendimento excluída com sucesso!";
        // Redireciona para a página de listagem após a exclusão
        // header('Location: listar_formas.php');
        // exit();
    } else {
        echo "Erro ao excluir forma de atendimento: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
