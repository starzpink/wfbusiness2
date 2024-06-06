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
            <label for="nome_emp">Nome da Empresa:</label>
            <input type="text" id="nome_emp" name="nome_emp" required></br>

            <label for="cod_local">Local:</label>
            <input type="text" id="cod_local" name="cod_local" required></br>

            <label for="areaat_emp">Área de Atuação:</label>
            <input type="text" id="areaat_emp" name="areaat_emp" required></br>

            <label for="desc_emp">Descrição:</label>
            <textarea id="desc_emp" name="desc_emp"></textarea></br>

            <label for="email_emp">E-mail de contato:</label>
            <input type="email" id="email_emp" name="email_emp" required></br>

            <label for="site_emp">Site:</label>
            <input type="text" id="site_emp" name="site_emp" required></br>

            <label for="tel_emp">Telefone:</label>
            <input type="text" id="tel_emp" name="tel_emp" required></br>

            <label for="cnpj_emp">CNPJ</label>
            <input type="text" id="cnpj_emp" name="cnpj_emp" required></br>

<!--segunda parte-->
            <label for="email">E-mail de Login:</label>
            <input type="email" id="email" name="email" required></br>

            <label for="senha">Senha:</label>
            <input type="password" id="confirmaSenha" name="confirmaSenha" required></br>

            <label for="confirmaSenha">Confirme a Senha:</label>
            <input type="password" id="confirmaSenha" name="confirmaSenha" required></br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
