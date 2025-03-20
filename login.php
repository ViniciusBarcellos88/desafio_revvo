<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = [
        'nome' => 'Vinicius Barcellos',
        'foto' => 'foto_perfil.jpg'
    ];

    $_SESSION['usuario'] = $usuario;
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma de Cursos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <img src="images/logos/logo-footer.png" alt="Logo da Plataforma">
            </div>
            <h2>Login</h2>
            <form action="autenticar.php" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn-login">Entrar</button>
            </form>
            <div class="login-links">
                <a href="recuperar-senha.php">Esqueceu sua senha?</a>
            </div>
        </div>
    </div>
</body>
</html>