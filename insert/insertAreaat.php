<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include './bd/conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into areaat(desc_area) "
    . "values ('" . $_POST['desc_area'] . "')";

if ($conn->query($sql) === TRUE) {
    $msg = "Área de atuação adicionada com sucesso!";
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);

?>