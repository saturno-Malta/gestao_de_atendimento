<?php
// Conexão com o banco de dados
require_once 'getConnection.php';

// Verifica se o ID do tipo de atendimento foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para excluir o tipo de atendimento
    $query = "DELETE FROM tipoatendimento WHERE idTipoAtendimento = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Tipo de Atendimento excluído com sucesso.";
    } else {
        echo "Erro ao excluir tipo de atendimento: " . mysqli_error($conn);
    }
} else {
    echo "ID do tipo de atendimento não fornecido.";
}

// Fechar conexão
mysqli_close($conn);
?>
