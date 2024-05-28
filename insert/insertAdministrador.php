<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into administrador(cod_adm, nome_adm, senha_adm, email_adm, tel_adm) "
        . "values (".$_POST['cod_adm'].",'".$_POST['nome_adm']."',"
        . "md5('".$_POST['senha_adm']."'),'".$_POST['email_adm']."','".$_POST['tel_adm']."')";

if($conn->query($sql) === TRUE){
    $msg = "Administrador criado com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
