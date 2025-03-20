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
    $stmt = $conn->prepare("DELETE FROM cursos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    die("Erro ao excluir o curso: " . $e->getMessage());
}
?>