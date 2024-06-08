<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script defer src="script.js"></script>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">
        <span class="logo">Workfolio for Business</span>
        </a>
    </nav>
    <div class="container">
        <h1>Cadastre-se</h1>
        <div class="formContainer">
        <form id="cadastroForm" action="process.php" method="post">
            <div class="campo">
            <label for="nome_emp">Nome da Empresa:</label>
            <input type="text" id="nome_emp" name="nome_emp" placeholder="Nome da Empresa" required></br>
            </div>
            <div class="campo">
            <label for="cod_local">Local:</label>
            <input type="text" id="cod_local" name="cod_local" required></br>
            </div>
            <div class="campo">
            <label for="areaat_emp">Área de Atuação:</label>
            <input type="text" id="areaat_emp" name="areaat_emp" required></br>
            </div>
            <div class="campo">
            <label for="desc_emp">Descrição:</label>
            <textarea id="desc_emp" name="desc_emp"></textarea></br>
            </div>
            <div class="campo">
            <label for="email_emp">E-mail de contato:</label>
            <input type="email" id="email_emp" name="email_emp" required></br>
            </div>
            <div class="campo">
            <label for="site_emp">Site:</label>
            <input type="text" id="site_emp" name="site_emp" required></br>
            </div>
            <div class="campo">
            <label for="tel_emp">Telefone:</label>
            <input type="text" id="tel_emp" name="tel_emp" required></br>
            </div>
            <div class="campo">
            <label for="cnpj_emp">CNPJ</label>
            <input type="text" id="cnpj_emp" name="cnpj_emp" required></br>
            </div>
            <!--segunda parte-->
            <div class="campo2">
            <label for="email">E-mail de Login:</label>
            <input type="email" id="email" name="email" required></br>
            </div>
            <div class="campo2">
            <label for="senha">Senha:</label>
            <input type="password" id="confirmaSenha" name="confirmaSenha" required></br>
            </div>
            <div class="campo2">
            <label for="confirmaSenha">Confirme a Senha:</label>
            <input type="password" id="confirmaSenha" name="confirmaSenha" required></br>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        </div>
    </div>
</body>
</html>
