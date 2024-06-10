<?php
include_once './conn.php';
include_once './usuario.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); // Supondo que a senha está armazenada como MD5 no banco de dados

    $stmt = $conn->prepare("SELECT cod_usuario, email, senha, cargo FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $usuario = null;

    if ($dados) {
        $usuario = new Usuario($dados["cod_usuario"], $dados["email"], $dados["senha"], $dados["cargo"]);
    }

    if ($usuario && $usuario->validaEmailSenha($email, $senha)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['cod_usuario'] = $usuario->getCodUsuario();
        $_SESSION['cargo'] = $usuario->getCargo();

        if ($usuario->getCargo() == 1) { // RH
            $stmt = $conn->prepare("SELECT cod_emp FROM rh WHERE cod_usuario = ?");
            $stmt->bind_param("i", $_SESSION['cod_usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            $rh = $result->fetch_assoc();
            $_SESSION['cod_emp'] = $rh['cod_emp'];
        } elseif ($usuario->getCargo() == 2) { // Empresa
            $stmt = $conn->prepare("SELECT cod_emp FROM empresa WHERE cod_usuario = ?");
            $stmt->bind_param("i", $_SESSION['cod_usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            $empresa = $result->fetch_assoc();
            $_SESSION['cod_emp'] = $empresa['cod_emp'];
        }

        // Redireciona o usuário para a página correta
        if ($usuario->getCargo() == 0) {
            header("Location: administracao.php");
        } elseif ($usuario->getCargo() == 1 || $usuario->getCargo() == 2) {
            header("Location: dashboard_emp.php");
        /*} elseif ($usuario->getCargo() == 2) {
            header("Location: dashboard_emp.php");*/
        }
        exit;
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
?>
