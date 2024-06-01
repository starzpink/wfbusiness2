<?php
include '../conn.php';
header('Content-type: application/json');

$sql = "insert into local_trabalho(cep_local, cidade_local, estado_local) "
        . "values ('".$_POST['cep_local']."','"
        .$_POST['cidade_local']."','".$_POST['estado_local']."')";

if($conn->query($sql) === TRUE){
    $msg = "Local adicionado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
