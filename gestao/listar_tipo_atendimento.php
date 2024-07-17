<?php
// Conexão com o banco de dados
require_once 'getConnection.php';

// Consulta para listar os tipos de atendimento
$query = "SELECT idTipoAtendimento, nomeTipoAtendimento FROM tipoatendimento";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro ao listar tipos de atendimento: " . mysqli_error($conn));
}

// Exibir resultados em uma tabela
echo "<h2>Tipos de Atendimento</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nome</th><th>Ações</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['idTipoAtendimento'] . "</td>";
    echo "<td>" . $row['nomeTipoAtendimento'] . "</td>";
    echo "<td><a href='edicao_tipo_atendimento.php?id=" . $row['idTipoAtendimento'] . "'>Editar</a> | 
              <a href='processa_exclusao_tipo_atendimento.php?id=" . $row['idTipoAtendimento'] . "'>Excluir</a></td>";
    echo "</tr>";
}

echo "</table>";

// Fechar conexão
mysqli_close($conn);
?>
