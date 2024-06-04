<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE local_trabalho SET 
    cod_comp = '" . $_POST['cod_comp'] . "', 
    cod_vaga = '" . $_POST['cod_vaga'] . "' 
    WHERE cod_req = " . (int)$_POST['cod_req'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Requisito atualizado com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>