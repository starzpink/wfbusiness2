<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into tipo_vaga(desc_tipo) "
        . "values ('".$_POST['desc_tipo']."')";

if($conn->query($sql) === TRUE){
    $msg = "Tipo de vaga adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>