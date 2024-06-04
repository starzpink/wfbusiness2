<?php
include '../conn.php';
session_start();

header('Content-type: application/json');

$sql = "UPDATE empresa SET 
    nome_emp = '" . $_POST['nome_emp'] . "', 
    cod_local = " . (int)$_POST['cod_local'] . ", 
    areaat_emp = " . (int)$_POST['areaat_emp'] . ", 
    desc_emp = '" . $_POST['desc_emp'] . "', 
    email_emp = '" . $_POST['email_emp'] . "', 
    site_emp = '" . $_POST['site_emp'] . "', 
    tel_emp = '" . $_POST['tel_emp'] . "', 
    cnpj_emp = '" . $_POST['cnpj_emp'] . "', 
    cod_usuario = " . (int)$_POST['cod_usuario'] . " 
    WHERE cod_emp = " . (int)$_POST['cod_emp'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Empresa atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>