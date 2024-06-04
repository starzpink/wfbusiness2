<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE competencia SET desc_comp = '" . $_POST['desc_comp'] . "'WHERE cod_comp = " . $_POST['cod_comp'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Competência atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>

