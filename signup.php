<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Formulário de Cadastro</h2>
        <form id="cadastroForm" action="process.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required></br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required></br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required></br>

            <label for="confirmaSenha">Confirme a Senha:</label>
            <input type="password" id="confirmaSenha" name="confirmaSenha" required></br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
