<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user'] = $user['login'];
        header('Location: ../admin/dashboard.php');
    } else {
        echo 'Login ou senha inválidos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - HRAV</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="POST">
        <label>Login:</label>
        <input type="text" name="login" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
