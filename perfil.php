<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["foto_perfil"])) {
    $diretorio_upload = "images/perfil/";
    $arquivo = $_FILES["foto_perfil"];
    $nome_arquivo = uniqid() . "_" . basename($arquivo["name"]);
    $caminho_arquivo = $diretorio_upload . $nome_arquivo;

    $tipo_imagem = strtolower(pathinfo($caminho_arquivo, PATHINFO_EXTENSION));
    $extensoes_permitidas = ["jpg", "jpeg", "png", "gif"];

    if (in_array($tipo_imagem, $extensoes_permitidas)) {
        if (move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo)) {
            $_SESSION["usuario"]["foto"] = $caminho_arquivo;
            echo "<script>alert('Foto de perfil atualizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao fazer upload da imagem.');</script>";
        }
    } else {
        echo "<script>alert('Formato de arquivo inválido. Use JPG, JPEG, PNG ou GIF.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="images/logos/logo.png" alt="Logo da Plataforma">
            </a>
        </div>
        <div class="top-bar">
            <div class="search-container">
                <form action="buscar.php" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="Buscar cursos..." required>
                    <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="divisoria-vertical"></div>
            <div class="profile" onclick="toggleMenu()">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<a href="#" class="profile-link">';
                    echo '<img src="' . $_SESSION['usuario']['foto'] . '" alt="Foto do Perfil">';
                    echo '<span>' . $_SESSION['usuario']['nome'] . '</span>';
                    echo '</a>';
                } else {
                    echo '<a href="login.php">Login</a>';
                }
                ?>
                <div class="profile-menu" id="profileMenu">
                    <a href="perfil.php">Ver Perfil</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1>Meu Perfil</h1>
        <div class="perfil-container">
            <div class="foto-perfil">
                <img src="<?php echo $_SESSION['usuario']['foto']; ?>" alt="Foto do Perfil">
            </div>
            <form action="perfil.php" method="POST" enctype="multipart/form-data" class="form-upload">
                <label for="foto_perfil">Alterar Foto de Perfil:</label>
                <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" required>
                <button type="submit" class="btn-upload">Enviar</button>
            </form>
        </div>
    </main>

    <script src="scripts.js"></script>
</body>
</html>