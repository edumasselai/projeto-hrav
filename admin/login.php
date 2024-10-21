<?php
session_start();
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['admin'];
    $password = $_POST['admin'];

    $query = "SELECT * FROM usuarios_admin WHERE username = $1";
    $result = pg_query_params($conexao, $query, [$username]);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id_usuario'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Login Administrativo</h1>
    <form action="login.php" method="POST">
        <label>Usuário:</label>
        <input type="text" name="username" required>
        <label>Senha:</label>
        <input type="password" name="password" required>
        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
