<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE areaat SET desc_area = '" . $_POST['desc_area'] . "'WHERE cod_area = " . $_POST['cod_area'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Área de Atuação atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>
