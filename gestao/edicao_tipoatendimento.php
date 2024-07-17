<?php
include_once('getConnection.php');

$conn = getConnection();

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTipoAtendimento = $_POST['id'];
    $descricao = $_POST['descricao'];

    $stmt = $conn->prepare("UPDATE tipoatendimento SET descricaoTipo = ? WHERE idTipoAtendimento = ?");

    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    $stmt->bind_param("si", $descricao, $idTipoAtendimento);

    if ($stmt->execute()) {
        echo "Tipo de atendimento atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar tipo de atendimento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $idTipoAtendimento = $_GET['id'];
    $result = $conn->query("SELECT * FROM tipoatendimento WHERE idTipoAtendimento = $idTipoAtendimento");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Editar Tipo de Atendimento</title>
        </head>
        <body>
            <h2>Editar Tipo de Atendimento</h2>
            <form action="edicao_tipoatendimento.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['idTipoAtendimento']; ?>">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" value="<?php echo $row['descricaoTipo']; ?>" required><br><br>
                <button type="submit">Atualizar</button>
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "Tipo de atendimento não encontrado.";
    }
}
?>
