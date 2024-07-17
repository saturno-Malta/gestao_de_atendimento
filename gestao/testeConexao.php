<?php
include 'getConnection.php';

$conn = getConnection();

if ($conn) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Conexão falhou!";
}

$conn->close();
?>
