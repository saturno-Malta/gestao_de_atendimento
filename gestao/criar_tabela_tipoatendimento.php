<?php
require 'getConnection.php';

$conn = getConnection();

$sql = "CREATE TABLE IF NOT EXISTS `tipoatendimento` (
    `idTipoAtendimento` INT NOT NULL AUTO_INCREMENT,
    `nomeTipoAtendimento` VARCHAR(255) NOT NULL,
    `dataCadastro` DATETIME NOT NULL,
    `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
    PRIMARY KEY (`idTipoAtendimento`)
) ENGINE = InnoDB;";

if ($conn->query($sql) === TRUE) {
    echo "Tabela tipoatendimento criada com sucesso!";
} else {
    echo "Erro ao criar a tabela: " . $conn->error;
}

$conn->close();
?>
