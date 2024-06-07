<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "insert into vaga(cod_local, cod_emp, cod_mod, cod_tipo, titulo_vaga, descricao_vaga, salario_vaga, horario_vaga) "
        . "values (".$_POST['cod_local'].","
        .$_POST['cod_emp'].",".$_POST['cod_mod'].",".$_POST['cod_tipo'].",'".$_POST['titulo_vaga']."','"
        .$_POST['descricao_vaga']."',".$_POST['salario_vaga'].",'".$_POST['horario_vaga']."')";

if($conn->query($sql) === TRUE){
    $msg = "Vaga adicionada com sucesso!";
} else {
    $msg = "Error: ".$sql."<br>".$conn->error;
}
//achar um jeito de incluir  $_SESSION['cod_emp'] ao inserir, atualizar e exibir dados de vagas, do rh e das modalidades nas vagas (alguém me ajuda)
$conn->close();

echo json_encode(['msg'=>$msg]);
        
?>
