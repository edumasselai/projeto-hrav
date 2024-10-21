<?php 
require_once '../includes/auth.php'; 
require_once '../config/db.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - HRAV</title>
    <link rel="stylesheet" href="../public/css/estilo.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Dashboard de Avaliações</h1>
    <table>
        <tr>
            <th>Setor</th>
            <th>Pergunta</th>
            <th>Média de Pontuação</th>
        </tr>
        <?php
        $stmt = $conn->query("
            SELECT s.nome AS setor, p.texto AS pergunta, AVG(a.resposta) AS media 
            FROM avaliacoes a 
            JOIN setores s ON a.setor_id = s.id 
            JOIN perguntas p ON a.pergunta_id = p.id 
            GROUP BY s.nome, p.texto
        ");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>{$row['setor']}</td><td>{$row['pergunta']}</td><td>" . number_format($row['media'], 2) . "</td></tr>";
        }
        ?>
    </table>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
