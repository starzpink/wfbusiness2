<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE local_trabalho SET 
    cep_local = '" . $_POST['cep_local'] . "', 
    cidade_local = '" . $_POST['cidade_local'] . "', 
    estado_local = '" . $_POST['estado_local'] . "' 
    WHERE cod_local = " . (int)$_POST['cod_local'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Local atualizado com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>