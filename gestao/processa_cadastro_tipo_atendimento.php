<?php
require_once 'getConnection.php';

$nomeAtendimento = $_POST['nomeAtendimento'];
$idUsuario = $_POST['idUsuario'];
$dataCadastro = date('Y-m-d H:i:s');

$conn = getConnection();

$sql = "INSERT INTO formaatendimento (nomeAtendimento, idUsuario, dataCadastro, ativo) VALUES (?, ?, ?, 'S')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sis', $nomeAtendimento, $idUsuario, $dataCadastro);

if ($stmt->execute()) {
    echo "Tipo de Atendimento cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar Tipo de Atendimento: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
