<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastrar Novo Curso</h2>
        <form action="salvar_curso.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Curso:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn">Salvar Curso</button>
        </form>
    </div>
</body>
</html>