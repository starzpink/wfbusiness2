<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into local_trabalho(cod_local, cep_local, cidade_local, estado_local) "
        . "values (".$_POST['cod_local'].",'".$_POST['cep_emp']."','"
        .$_POST['cidade_emp']."','".$_POST['estado_emp']."')";

if($conn->query($sql) === TRUE){
    $msg = "Local adicionado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
