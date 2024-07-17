<?php
// Incluir o arquivo de conexão
include_once('getConnection.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nomePublico = $_POST['nomePublico'] ?? '';
    $idUsuario = $_POST['idUsuario'] ?? '';

    // Validar se os campos foram preenchidos
    if (empty($nomePublico) || empty($idUsuario)) {
        die("Por favor, preencha todos os campos.");
    }

    // Estabelecer conexão com o banco de dados
    $conn = getConnection();

    // Verificar a conexão
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Verificar se o idUsuario existe na tabela usuario
    $checkUserQuery = "SELECT idUsuario FROM usuario WHERE idUsuario = ?";
    $stmtCheck = $conn->prepare($checkUserQuery);
    $stmtCheck->bind_param("i", $idUsuario);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    // Se o idUsuario não existir, exibir mensagem de erro
    if ($stmtCheck->num_rows == 0) {
        die("Erro ao cadastrar público: Usuário não encontrado.");
    }

    // Preparar a consulta SQL para inserir na tabela publico
    $insertQuery = "INSERT INTO publico (idUsuario, nomePublico, dataCadastro, ativo) VALUES (?, ?, NOW(), 'S')";
    $stmt = $conn->prepare($insertQuery);

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    // Bind dos parâmetros e execução da consulta
    $stmt->bind_param("is", $idUsuario, $nomePublico);

    if ($stmt->execute()) {
        echo "Público cadastrado com sucesso!";
        // Exemplo de redirecionamento após 2 segundos
        header("refresh:2;url=listar_publicos.php");
        exit();
    } else {
        echo "Erro ao cadastrar público: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>

<!-- Formulário HTML para cadastro de público -->
<form action="cadastro_publico.php" method="post">
    <label for="nomePublico">Nome do Público:</label>
    <input type="text" id="nomePublico" name="nomePublico" required>
    <!-- Adicione um campo hidden para enviar o idUsuario -->
    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
    <button type="submit">Cadastrar</button>
</form>
