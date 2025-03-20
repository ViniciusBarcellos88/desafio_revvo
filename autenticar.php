<?php
session_start();

$usuarios = [
    "usuario1@example.com" => [
        "nome" => "Vinicius Barcellos",
        "senha" => password_hash("senha123", PASSWORD_BCRYPT),
        "foto" => "images/foto1.jpg"
    ],
    "usuario2@example.com" => [
        "nome" => "Maria Souza",
        "senha" => password_hash("senha456", PASSWORD_BCRYPT),
        "foto" => "images/foto2.jpg"
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (isset($usuarios[$email])) {
        if (password_verify($senha, $usuarios[$email]["senha"])) {
            $_SESSION["usuario"] = [
                "nome" => $usuarios[$email]["nome"],
                "foto" => $usuarios[$email]["foto"]
            ];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('E-mail não cadastrado!'); window.location.href = 'login.php';</script>";
    }
}
?>