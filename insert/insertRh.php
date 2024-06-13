<?php
session_start();
$cod_emp = $_SESSION['cod_emp'];

include '../conn.php';

header('Content-type: application/json');

$sql_usuario = "INSERT INTO usuario (email, senha, cargo) "
        . "VALUES ('".$_POST['email']."', MD5('".$_POST['senha']."'), 1)";
if($conn->query($sql_usuario) === TRUE){
    $cod_usuario = $conn->insert_id; // Recupera o ID gerado pelo banco de dados
    
    $conn->query("SET @cod_usuario = $cod_usuario");

    $sql_rh = "INSERT INTO rh(cod_emp, nome_rh, cpf_rh, email_rh, tel_rh, cod_usuario) "
        . "VALUES ($cod_emp,'".$_POST['nome_rh']."',"
        .$_POST['cpf_rh'].",'".$_POST['email_rh']."','".$_POST['tel_rh']."', $cod_usuario)";

    if($conn->query($sql_rh) === TRUE){
        $msg = "RH adicionado com sucesso!";
    } else {
        $msg = "Erro ao adicionar RH: ".$conn->error;
    }
} else {
    $msg = "Erro ao adicionar usuário: ".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
?>