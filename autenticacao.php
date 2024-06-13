<?php
include './bd/conn.php';
include_once './bd/usuario.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

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


        echo "Cargo do usuário: " . $_SESSION['cargo'] . "<br>";

        if ($usuario->getCargo() == 1) { // RH
            $stmt = $conn->prepare("SELECT cod_emp FROM rh WHERE cod_usuario = ?");
            $stmt->bind_param("i", $_SESSION['cod_usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            $rh = $result->fetch_assoc();

            if ($rh) {
                $_SESSION['cod_emp'] = $rh['cod_emp'];

                echo "Código da empresa (RH): " . $_SESSION['cod_emp'] . "<br>";
            } else {
                echo "Erro ao recuperar o código da empresa para RH<br>";
            }

        } elseif ($usuario->getCargo() == 2) { // Empresa
            $stmt = $conn->prepare("SELECT cod_emp FROM empresa WHERE cod_usuario = ?");
            $stmt->bind_param("i", $_SESSION['cod_usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            $empresa = $result->fetch_assoc();

            if ($empresa) {
                $_SESSION['cod_emp'] = $empresa['cod_emp'];

                echo "Código da empresa (Empresa): " . $_SESSION['cod_emp'] . "<br>";
            } else {
                echo "Erro ao recuperar o código da empresa para Empresa<br>";
            }
        }

        switch ($usuario->getCargo()) {
            case 0:
                header("Location: administracao.php");
                break;
            case 1:
                header("Location: dashboard.php");
                break;
            case 2:
                header("Location: dashboard.php");
                break;
            default:
                header("Location: login.php");
                break;
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