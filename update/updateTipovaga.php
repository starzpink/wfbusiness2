<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE areaat SET desc_tipo = '" . $_POST['desc_tipo'] . "'WHERE cod_tipo = " . $_POST['cod_tipo'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Tipo de vaga atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>
