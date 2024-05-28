<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into sede(cod_sede, cod_emp, cod_local) "
        . "values (".$_POST['cod_sede'].",".$_POST['cod_emp'].",".$_POST['cod_local'].")";

if($conn->query($sql) === TRUE){
    $msg = "Sede criado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
