<?php
include '../conn.php';
header('Content-type: application/json');

$sql = "insert into empresa(nome_emp, senha, sede_emp, areaat_emp, desc_emp, email_emp, site_emp, tel_emp, cnpj_emp) "
        . "values ('".$_POST['nome_emp']."', md5('".$_POST['senha']."'),"
        .$_POST['sede_emp'].",".$_POST['areaat_emp'].",'".$_POST['desc_emp']."','".$_POST['email_emp']."','"
        .$_POST['site_emp']."','".$_POST['tel_emp']."','".$_POST['cnpj_emp']."')";

if($conn->query($sql) === TRUE){
    $msg = "Empresa adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
