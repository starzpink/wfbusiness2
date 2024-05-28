<?php
include './conn.php';
header('Content-type: application/json');

$sql = "insert into vaga(cod_vaga, cod_local, cod_emp, cod_mod, cod_tipo, titulo_vaga, descricao_vaga, salario_vaga, horario_vaga) "
        . "values (".$_POST['cod_vaga'].",".$_POST['cod_local'].","
        .$_POST['cod_emp'].",".$_POST['cod_mod'].",".$_POST['cod_tipo'].",'".$_POST['titulo_vaga']."','"
        .$_POST['descricao_vaga']."',".$_POST['salario_vaga'].",'".$_POST['horario_vaga']."')";

if($conn->query($sql) === TRUE){
    $msg = "Vaga adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
