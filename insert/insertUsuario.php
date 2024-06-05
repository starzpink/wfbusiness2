<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into usuario(email, senha, cargo) "
        . "values ('".$_POST['email']."',md5('".$_POST['senha']."'),"
        . $_POST['cargo'].")";

if($conn->query($sql) === TRUE){
    $msg = "Usuario adicionado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);


?>
