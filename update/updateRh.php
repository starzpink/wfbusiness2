<?php
include '../conn.php';

header('Content-type: application/json');

$sql = "UPDATE rh SET 
cod_emp = " . (int) $_POST['cod_emp'] . ",
nome_rh = '" . $_POST['nome_rh'] . "',
cpf_rh = '" . $_POST['cpf_rh'] . "',
email_rh = '" . $_POST['email_rh'] . "',
tel_rh = '" . $_POST['tel_rh'] . "'
WHERE cod_rh = " . (int) $_POST['cod_rh'];

if ($conn->query($sql) === TRUE) {
    $msg = "RH atualizado com sucesso!";
} else {
    //$msg = "Error: ".$sql."<br>".$conn-error;    
    $msg = "Erro";
}
$conn->close();
echo json_encode(['msg' => $msg]);
?>