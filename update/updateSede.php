<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "UPDATE local_trabalho SET 
    cod_emp = " . (int)$_POST['cod_emp'] . ", 
    cod_local = " . (int)$_POST['cod_local'] . " 
    WHERE cod_sede = " . (int)$_POST['cod_sede'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Sede atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>