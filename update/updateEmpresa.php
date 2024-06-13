<?php
session_start();
include '../conn.php';

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cod_usuario'])) {
    $cod_usuario = intval($_SESSION['cod_usuario']);

    $conn->query("SET @cod_usuario = $cod_usuario");

    // Atualiza a tabela usuário
    $sql_usuario = "UPDATE usuario SET email = '" . $_POST['email'] . "', senha = MD5('" . $_POST['senha'] . "') WHERE cod_usuario = $cod_usuario";

    if ($conn->query($sql_usuario) === TRUE) {
        // Atualiza a tabela empresa
        $sql_empresa = "UPDATE empresa SET nome_emp = '" . $_POST['nome_emp'] . "', cod_local = " . $_POST['cod_local'] . ", areaat_emp = " . $_POST['areaat_emp'] . ", desc_emp = '" . $_POST['desc_emp'] . "', email_emp = '" . $_POST['email_emp'] . "', site_emp = '" . $_POST['site_emp'] . "', tel_emp = '" . $_POST['tel_emp'] . "', cnpj_emp = '" . $_POST['cnpj_emp'] . "' WHERE cod_usuario = $cod_usuario";

        if ($conn->query($sql_empresa) === TRUE) {
            $msg = "Dados da empresa atualizados com sucesso!";
        } else {
            $msg = "Erro ao atualizar os dados da empresa: " . $conn->error;
        }
    } else {
        $msg = "Erro ao atualizar os dados do usuário: " . $conn->error;
    }

    $conn->close();

    echo json_encode(['msg' => $msg]);
    exit;
} else {
    echo json_encode(['msg' => 'Método de requisição inválido ou cod_usuario não encontrado na sessão.']);
    exit;
}
?>
