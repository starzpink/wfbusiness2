<!DOCTYPE html>
<?php session_start(); ?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <nav class="navbar">
        <a href="index.php">
        <span class="logo">Workfolio for Business</span>
        </a>
    </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="administracao.php" method="POST">
                        <h1>Entre com o e-mail</h1>
                        <?php if (isset($_SESSION['msg'])) { ?>
                            <p style="color: red;"><?php echo $_SESSION['msg']; ?></p>
                            <?php session_destroy(); ?>
                        <?php } ?>
                        <div class="form-group">
                            <p>E-mail</p>
                            <input type="text" name="email" placeholder="nome@exemplo.com" required>
                        </div>
                        <div class="form-group">
                            <p>Senha</p>
                            <input type="password" name="senha" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Entrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Scripts Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
