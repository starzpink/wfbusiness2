<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script defer src="script/signup.js"></script>
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
            <form id="cadastroForm" onsubmit="return comparaSenha()" action="insert/insertEmpresa.php" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <div class="campo">
                        <label for="confirmarSenha">Confirme a Senha:</label>
                        <input type="password" id="confirmarSenha" name="confirmarSenha" required>
                        <span class="senhadiferente"></span>
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo"
                        disabled>
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_emp">Nome da Empresa:</label>
                        <input type="text" id="nome_emp" name="nome_emp" required>
                    </div>
                    <div class="campo">
                        <label for="cod_local">Local:</label>
                        <select id="cod_local" name="cod_local" required></select>
                    </div>
                    <div class="campo">
                        <label for="areaat_emp">Área de Atuação:</label>
                        <select id="areaat_emp" name="areaat_emp" required></select>
                    </div>
                    <div class="campo">
                        <label for="desc_emp">Descrição:</label>
                        <textarea id="desc_emp" name="desc_emp" required></textarea>
                    </div>
                    <div class="campo">
                        <label for="email_emp">E-mail de contato:</label>
                        <input type="email" id="email_emp" name="email_emp" required>
                    </div>
                    <div class="campo">
                        <label for="site_emp">Site:</label>
                        <input type="text" id="site_emp" name="site_emp" required>
                    </div>
                    <div class="campo">
                        <label for="tel_emp">Telefone:</label>
                        <input type="text" id="tel_emp" name="tel_emp" required>
                    </div>
                    <div class="campo">
                        <label for="cnpj_emp">CNPJ</label>
                        <input type="text" id="cnpj_emp" name="cnpj_emp" required>
                    </div>
                    <input type="submit" class="btCadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
