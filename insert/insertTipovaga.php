<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into tipo_vaga(cod_tipo, desc_tipo) "
        . "values (".$_POST['cod_tipo'].",'".$_POST['desc_tipo']."')";

if($conn->query($sql) === TRUE){
    $msg = "Empresa criado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
