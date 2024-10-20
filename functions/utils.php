<?php
function getPerguntas() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, texto FROM perguntas WHERE status = TRUE");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
