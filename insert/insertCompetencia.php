<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into competencia(cod_comp, desc_comp) "
        . "values (".$_POST['cod_comp'].",'".$_POST['desc_comp']."')";

if($conn->query($sql) === TRUE){
    $msg = "compinistrador criado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
