<?php
include '../conn.php';
header('Content-type: application/json');

$sql = "insert into rh(cod_emp, nome_rh, senha_rh, cpf_rh, email_rh, tel_rh) "
        . "values (".$_POST['cod_emp'].",'".$_POST['nome_rh']."',"
        . "md5('".$_POST['senha_rh']."'),".$_POST['cpf_rh'].",'".$_POST['email_rh']."','".$_POST['tel_rh']."')";

if($conn->query($sql) === TRUE){
    $msg = "RH adicionado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);


?>
