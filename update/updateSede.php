<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE local_trabalho SET 
    cod_emp = '" . $_POST['cod_emp'] . "', 
    cod_local = '" . $_POST['cod_local'] . "' 
    WHERE cod_sede = " . (int)$_POST['cod_sede'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Sede atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>