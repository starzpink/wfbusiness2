<?php
include './conn.php';

header('Content-type: application/json');

$sql = "update rh set cod_emp=".$_POST['´cod_emp']
        .", nome_rh='".$_POST['nome_rh']
        ."', cpf_rh='".$_POST['cpf_rh']."', "
        ." email_rh='".$_POST['email_rh']."', "
        ." tel_rh ='".$_POST['tel_rh']."', "
        ." where cod_rh = ".$_POST['cod_rh']."";

if($conn->query($sql) === TRUE){
    $msg = "RH atualizado com sucesso!";
} else {
    //$msg = "Error: ".$sql."<br>".$conn-error;    
    $msg = "Erro";
}
$conn->close();
echo json_encode(['msg'=>$msg]);
?>

