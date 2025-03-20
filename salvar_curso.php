<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];

    try {
        $stmt = $conn->prepare("INSERT INTO cursos (nome, descricao) VALUES (:nome, :descricao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar o curso: " . $e->getMessage());
    }
}
?>