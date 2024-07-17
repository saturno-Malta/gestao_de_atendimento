<?php
include_once('getConnection.php');

$conn = getConnection();

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

$result = $conn->query("SELECT * FROM tipoatendimento");

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Data Cadastro</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['idTipoAtendimento'] . "</td>
                <td>" . $row['descricaoTipo'] . "</td>
                <td>" . $row['dataCadastro'] . "</td>
                <td>" . $row['ativo'] . "</td>
                <td>
                    <a href='edicao_tipoatendimento.php?id=" . $row['idTipoAtendimento'] . "'>Editar</a> |
                    <a href='exclusao_tipoatendimento.php?id=" . $row['idTipoAtendimento'] . "'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum tipo de atendimento encontrado.";
}

$conn->close();
?>
