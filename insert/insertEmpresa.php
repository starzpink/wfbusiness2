<?php
include '../conn.php';
header('Content-type: application/json');

$sql = "insert into empresa(nome_emp, cod_local, areaat_emp, desc_emp, email_emp, site_emp, tel_emp, cnpj_emp, cod_usuario) "
        . "values ('".$_POST['nome_emp']."',"
        .$_POST['cod_local'].",".$_POST['areaat_emp'].",'".$_POST['desc_emp']."','".$_POST['email_emp']."','"
        .$_POST['site_emp']."','".$_POST['tel_emp']."','".$_POST['cnpj_emp']."',".$_POST['cod_usuario'].")";

if($conn->query($sql) === TRUE){
    $msg = "Empresa adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
