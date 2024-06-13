<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "UPDATE modalidade SET desc_mod = '" . $_POST['desc_mod'] . "'WHERE cod_mod = " . $_POST['cod_mod'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Modalidade atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>
