<?php
$classe = isset($_GET["classe"]) ? $_GET["classe"] : "";
include_once './conn.php';
include_once './usuario.php';
session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = mysqli_query($conn, "select cod_usuario, email, senha, cargo from usuario where email = '" . $email . "'");
    $dados = mysqli_fetch_assoc($consulta);
    $usuario = null;
    if ($dados != null) {
        $usuario = new Usuario($dados["cod_usuario"], $dados["email"], $dados["senha"], $dados['cargo']);
    }

    if ($usuario != null && $usuario->validaEmailSenha($email, md5($senha))) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['cod_usuario'] = $dados["cod_usuario"];
    } else {
        $_SESSION['msg'] = "E-mail ou senha incorretos.";
        header("Location: login.php");
        exit;
    }

} else if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "É necessário logar antes de acessar.";
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sbstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard</title>
</head>
<body class="v-body">
    <nav class="nav-sidebar">
                <?php include 'sidebar.php'; ?>
    </nav>
    <div class="v-principal">
        <h1>Dashboard</h1>
        <div class="dash-top">
            <div class="dash-vagas-abertas">
                <h2>vagas</h2>
            </div>
            <div class="dash-portfolios-recebidos">
                <h2>portfolios recebidos</h2>
            </div>
            <div class="dash-contratados">
                <h2>contrat<h2>
            </div>
        </div>
        <div class="dash-meio">
            <div class="dash-graf-vagas">
                <h2>graf vaga</h2>
            </div>
            <div class="dash-graf-modali">
                <h2>graf modali</h2>
            </div>
        </div>
        <div class="dash-bot">
            <div class="dash-ano">
                <h2>fome</h2>
            </div>
        </div>
    </div>
</body>
</html>