<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE usuario SET 
    email = '" . $_POST['email'] . "', 
    senha = '" . md5($_POST['senha']) . "', 
    cargo = " . (int) $_POST['cargo'] . " 
    WHERE cod_usuario = " . (int)$_POST['cod_usuario'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Usuário atualizado com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>