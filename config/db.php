<?php
$host = 'localhost';
$dbname = 'avaliacao_hospitalar';
$user = 'postgres';
$password = 'senha123';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>
