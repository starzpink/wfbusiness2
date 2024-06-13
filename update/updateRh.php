<?php
session_start();
include '../conn.php';

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cod_usuario'])) {
    $cod_usuario = intval($_SESSION['cod_usuario']);

    $conn->query("SET @cod_usuario = $cod_usuario");

    $sql_usuario = "UPDATE usuario SET email = '" . $_POST['email'] . "', senha = MD5('" . $_POST['senha'] . "') WHERE cod_usuario = $cod_usuario";

    if ($conn->query($sql_usuario) === TRUE) {
        $sql_rh = "UPDATE rh SET nome_rh = '" . $_POST['nome_rh'] . "', cpf_rh = '" . $_POST['cpf_rh'] . "', email_rh = '" . $_POST['email_rh'] . "', tel_rh = '" . $_POST['tel_rh'] . "' WHERE cod_usuario = $cod_usuario";

        if ($conn->query($sql_rh) === TRUE) {
            $msg = "Dados do RH atualizados com sucesso!";
        } else {
            $msg = "Erro ao atualizar os dados do RH: " . $conn->error;
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