<?php
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

if ($dados['cargo'] == 0){   
    include 'administracao.php';
} else if ($dados['cargo'] == 1) {
    include 'dashboard.php';
} else if ($dados['cargo'] == 2) {
    include 'dashboard_emp.php';
}
?>
