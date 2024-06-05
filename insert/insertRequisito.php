<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into requisito(cod_comp, cod_vaga) "
        . "values (".$_POST['cod_comp'].",'".$_POST['cod_vaga']."')";

if($conn->query($sql) === TRUE){
    $msg = "Requisito adicionado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);

?>
