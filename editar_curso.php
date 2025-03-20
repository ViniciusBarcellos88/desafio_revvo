<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once 'conexao.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$curso) {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erro ao buscar curso: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];

    try {
        $stmt = $conn->prepare("UPDATE cursos SET nome = :nome, descricao = :descricao WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao atualizar o curso: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="cadastro-container">
        <h2>Editar Curso</h2>
        <form action="editar_curso.php?id=<?= $id ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Curso:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($curso['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($curso['descricao']) ?></textarea>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>