<?php require_once '../config/db.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliação - HRAV</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <h1>Avalie nossos serviços</h1>
    <form action="agradecimento.php" method="POST">
        <?php
        $stmt = $conn->query("SELECT id, texto FROM perguntas WHERE status = 'ativa'");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<label>{$row['texto']}</label>";
            echo "<input type='number' name='resposta[{$row['id']}]' min='0' max='10' required><br>";
        }
        ?>
        <label>Comentário adicional (opcional):</label>
        <textarea name="feedback" rows="4"></textarea>
        <button type="submit">Enviar Avaliação</button>
    </form>
    <footer>
        <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
    </footer>
</body>
</html>
