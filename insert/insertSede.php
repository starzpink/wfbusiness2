<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into sede(cod_emp, cod_local) "
        . "values (".$_POST['cod_emp'].",".$_POST['cod_local'].")";

if($conn->query($sql) === TRUE){
    $msg = "Sede adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
