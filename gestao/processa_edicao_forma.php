<?php
include 'getConnection.php';

$conn = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idFormaAtendimento'])) {
    $idFormaAtendimento = $_POST['idFormaAtendimento'];
    $nomeAtendimento = $_POST['nomeAtendimento'];

    // Prepara a query SQL para atualização
    $sql = "UPDATE formaatendimento SET nomeAtendimento = ? WHERE idFormaAtendimento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nomeAtendimento, $idFormaAtendimento);

    if ($stmt->execute()) {
        echo "Forma de atendimento atualizada com sucesso!";
        // Redireciona para a página de listagem após a atualização
        // header('Location: listar_formas.php');
        // exit();
    } else {
        echo "Erro ao atualizar forma de atendimento: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
