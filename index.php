<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once 'conexao.php';

try {
    $stmt = $conn->query("SELECT * FROM cursos");
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar cursos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Cursos</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logos/logo.png" alt="Logo da Plataforma">
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

    <section class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banners/banner1.jpg" alt="Banner 1">
                <div class="carousel-text">
                    <h2>Título do Banner 1</h2>
                    <p>Descrição do Banner 1.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/banners/banner2.jpg" alt="Banner 2">
                <div class="carousel-text">
                    <h2>Título do Banner 2</h2>
                    <p>Descrição do Banner 2.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/banners/banner3.jpg" alt="Banner 3">
                <div class="carousel-text">
                    <h2>Título do Banner 3</h2>
                    <p>Descrição do Banner 3.</p>
                </div>
            </div>
        </div>
        <button class="carousel-prev">&#10094;</button>
        <button class="carousel-next">&#10095;</button>
    </section>

    <section class="meus-cursos">
        <div class="titulo-container">
            <h2>Meus Cursos</h2>
            <div class="divisoria"></div>
        </div>
        <div class="cursos-container">
            <?php foreach ($cursos as $curso): ?>
                <div class="curso-card">
                    <div class="menu-opcoes">
                        <button class="btn-opcoes" onclick="toggleOpcoes(this)">&#8942;</button>
                        <div class="opcoes-dropdown">
                            <a href="editar_curso.php?id=<?= $curso['id'] ?>" class="opcao">Editar</a>
                            <a href="#" class="opcao" onclick="abrirModalExcluir(<?= $curso['id'] ?>)">Excluir</a>
                        </div>
                    </div>
                    <img src="images/cursos/card.jpg" alt="<?= htmlspecialchars($curso['nome']) ?>">
                    <div class="curso-info">
                        <h3><?= htmlspecialchars($curso['nome']) ?></h3>
                        <p><?= htmlspecialchars($curso['descricao']) ?></p>
                        <a href="#" class="btn">Ver Curso</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="curso-card add-curso">
                <a href="cadastro_curso.php" class="add-curso-link">
                    <div class="add-curso-content">
                        <span>+</span>
                        <p>Adicionar Novo Curso</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-left">
            <img src="images/logos/logo-footer.png" alt="Logo da Plataforma">
        </div>
        <div class="footer-right">
            <div class="contato">
                <p class="contato-titulo">CONTATO</p>
                <p>suporte@plataforma.com</p>
                <p>(11) 98765-4321</p>
            </div>
            <div class="redes-sociais">
                <p class="redes-sociais-texto">REDES SOCIAIS</p>
                <div class="social-icons-container">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
    <div id="modalBoasVindas" class="modal-boas-vindas">
    <div class="modal-conteudo">
        <span class="fechar-modal" onclick="fecharModalBoasVindas()">&times;</span>
        <div class="modal-imagem">
            <img src="images/modal/welcome.jpg" alt="Bem-vindo à Plataforma">
        </div>
        <div class="modal-texto">
            <h2>Bem-vindo à Plataforma de Cursos!</h2>
            <p>Aqui você encontra os melhores cursos para impulsionar sua carreira. Explore nossos conteúdos e comece a aprender hoje mesmo!</p>
            <button class="btn-inscrever">Inscreva-se Agora</button>
        </div>
    </div>
    </div>
    <div id="modalExcluir" class="modal-excluir">
        <div class="modal-conteudo">
            <h2>Confirmar Exclusão</h2>
            <p>Tem certeza que deseja excluir este curso?</p>
            <div class="modal-botoes">
                <button onclick="confirmarExclusao()" class="btn btn-perigo">Sim</button>
                <button onclick="fecharModalExcluir()" class="btn btn-secundario">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>