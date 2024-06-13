<!DOCTYPE html>
<?php session_start(); ?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Workfolio</title>
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
        <h1>Login</h1>
        <div class="formContainer">
            <form action="autenticacao.php" method="POST">
                <div class="parte1">
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="nome@exemplo.com" autocomplete="email"
                            required>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="***********" required>
                    </div>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <p style="color: red;"><?php echo $_SESSION['msg']; ?></p>
                        <?php session_destroy(); ?>
                    <?php } ?>
                    <div class="campo">
                        <input type="submit" value="Entrar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>