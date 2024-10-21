<?php
include_once 'includes/db.php';

// Buscando perguntas ativas
$query = "SELECT * FROM perguntas WHERE status = TRUE";
$result = pg_query($conexao, $query);
$perguntas = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Serviços HRAV</title>
    <link rel="stylesheet" href="public/css/estilo.css">
</head>
<body>
    <h1>Avaliação de Serviços</h1>
    <form action="public/login.php" method="POST">
        <?php foreach ($perguntas as $pergunta): ?>
            <label><?= htmlspecialchars($pergunta['texto']); ?></label>
            <input type="range" name="respostas[<?= $pergunta['id_pergunta'] ?>]" min="0" max="10">
        <?php endforeach; ?>
        
        <label>Feedback adicional (opcional)</label>
        <textarea name="feedback"></textarea>

        <p><strong>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</strong></p>
        <button type="submit">Enviar Avaliação</button>
    </form>
</body>
</html>
