<?php
session_start();

include '../conn.php';

header('Content-type: application/json');

$sql_usuario = "INSERT INTO usuario (email, senha, cargo) "
    . "VALUES ('" . $_POST['email'] . "', MD5('" . $_POST['senha'] . "'), 2)";
if ($conn->query($sql_usuario) === TRUE) {
    $cod_usuario = $conn->insert_id; // Recupera o ID gerado pelo banco de dados

    $conn->query("SET @cod_usuario = $cod_usuario");

    $sql_empresa = "INSERT INTO empresa(nome_emp, cod_local, areaat_emp, desc_emp, email_emp, site_emp, tel_emp, cnpj_emp, cod_usuario) "
        . "VALUES ('" . $_POST['nome_emp'] . "',"
        . $_POST['cod_local'] . "," . $_POST['areaat_emp'] . ",'" . $_POST['desc_emp'] . "','" . $_POST['email_emp'] . "','"
        . $_POST['site_emp'] . "','" . $_POST['tel_emp'] . "','" . $_POST['cnpj_emp'] . "',$cod_usuario)";

    if ($conn->query($sql_empresa) === TRUE) {
        $msg = "Empresa adicionada com sucesso!";
    } else {
        $msg = "Erro ao adicionar empresa: " . $conn->error;
    }
} else {
    $msg = "Erro ao adicionar usuário: " . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);

header("Location: perfilempresa.php");
exit;
?>