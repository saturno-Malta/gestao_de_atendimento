<?php
require_once 'getConnection.php';

$idFormaAtendimento = $_POST['idFormaAtendimento'];
$nomeAtendimento = $_POST['nomeAtendimento'];

$conn = getConnection();

$sql = "UPDATE formaatendimento SET nomeAtendimento = ? WHERE idFormaAtendimento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $nomeAtendimento, $idFormaAtendimento);

if ($stmt->execute()) {
    echo "Tipo de Atendimento atualizado com sucesso!";
} else {
    echo "Erro ao atualizar Tipo de Atendimento: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
