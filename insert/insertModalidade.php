<?php
include '../conn.php';
header('Content-type: application/json');

$sql = "insert into modalidade(desc_mod) "
        . "values ('".$_POST['desc_mod']."')";

if($conn->query($sql) === TRUE){
    $msg = "Modalidade adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>