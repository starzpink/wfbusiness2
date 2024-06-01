<?php
include '../conn.php';
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
