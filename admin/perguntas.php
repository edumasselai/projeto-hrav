<?php
session_start();
include_once '../includes/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Lida com a adição/edição de perguntas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto_pergunta = $_POST['texto_pergunta'];
    $id_pergunta = $_POST['id_pergunta'] ?? null;  // Verifica se é edição ou nova pergunta

    if ($id_pergunta) {
        // Atualizando a pergunta existente
        $query = "UPDATE perguntas SET texto = $1 WHERE id_pergunta = $2";
        pg_query_params($conexao, $query, [$texto_pergunta, $id_pergunta]);
    } else {
        // Inserindo nova pergunta
        $query = "INSERT INTO perguntas (texto) VALUES ($1)";
        pg_query_params($conexao, $query, [$texto_pergunta]);
    }
    header('Location: perguntas.php');
    exit();
}

// Lida com a remoção de perguntas
if (isset($_GET['delete'])) {
    $id_pergunta = $_GET['delete'];
    $query = "DELETE FROM perguntas WHERE id_pergunta = $1";
    pg_query_params($conexao, $query, [$id_pergunta]);
    header('Location: perguntas.php');
    exit();
}

// Buscando todas as perguntas
$query = "SELECT * FROM perguntas";
$result = pg_query($conexao, $query);
$perguntas = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Perguntas</title>
    <link rel="stylesheet" href="../assets/estilo.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Gerenciar Perguntas</h1>

    <!-- Formulário de Adição/Edição de Perguntas -->
    <form action="perguntas.php" method="POST">
        <input type="hidden" name="id_pergunta" id="id_pergunta" value="">
        <label for="texto_pergunta">Texto da Pergunta:</label>
        <textarea name="texto_pergunta" id="texto_pergunta" required></textarea>
        <button type="submit">Salvar Pergunta</button>
    </form>

    <!-- Listagem de Perguntas -->
    <h2>Perguntas Atuais</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Texto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($perguntas): ?>
                <?php foreach ($perguntas as $pergunta): ?>
                    <tr>
                        <td><?= $pergunta['id_pergunta']; ?></td>
                        <td><?= htmlspecialchars($pergunta['texto']); ?></td>
                        <td>
                            <a href="javascript:void(0)" onclick="editPergunta(<?= $pergunta['id_pergunta']; ?>, '<?= htmlspecialchars($pergunta['texto']); ?>')">Editar</a>
                            <a href="perguntas.php?delete=<?= $pergunta['id_pergunta']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta pergunta?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhuma pergunta cadastrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php include '../includes/footer.php'; ?>

    <script>
        function editPergunta(id, texto) {
            document.getElementById('id_pergunta').value = id;
            document.getElementById('texto_pergunta').value = texto;
        }
    </script>
</body>
</html>
