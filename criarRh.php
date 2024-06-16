<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="script/criarRh.js"></script>
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
            <form id="cadastroForm" action="insert/insertRh.php" method="post">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail de Login:</label>
                        <input type="email" id="email" name="email" required><br>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required><br>
                    </div>
                    <div class="campo">
                        <label for="confirmaSenha">Confirme a Senha:</label>
                        <input type="password" id="confirmaSenha" name="confirmaSenha" required><br>
                    </div>
                    <input type="button" class="visible_submit" id="visible_submit" onclick="prox()" value="Próximo">
                </div>
                <div class="parte2" style="display:none;">
                    <div class="campo">
                        <label for="nome_rh">Nome:</label>
                        <input type="text" id="nome_rh" name="nome_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="cpf_rh">CPF:</label>
                        <input type="text" id="cpf_rh" name="cpf_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="email_rh">E-mail:</label>
                        <input type="email" id="email_rh" name="email_rh" required><br>
                    </div>
                    <div class="campo">
                        <label for="tel_rh">Telefone:</label>
                        <input type="text" id="tel_rh" name="tel_rh" required><br>
                    </div>
                    <div id="toast"></div>
                    <input type="submit" class="btCadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>