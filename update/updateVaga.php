<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include './bd/conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "UPDATE vaga SET 
    cod_vaga = " . $_POST['cod_vaga'] . ", 
    titulo_vaga = '" . $_POST['titulo_vaga'] . "', 
    descricao_vaga = '" . $_POST['descricao_vaga'] . "', 
    salario_vaga = '" . $_POST['salario_vaga'] . "', 
    cod_local = " . $_POST['cod_local'] . ", 
    cod_mod = " . $_POST['cod_mod'] . ", 
    cod_tipo = " . $_POST['cod_tipo'] . ", 
    horario_vaga = '" . $_POST['horario_vaga'] . "', 
    situacao_vaga = '" . $_POST['situacao_vaga'] . "',
    cod_emp = " . $_SESSION['cod_emp'] . "
    WHERE cod_vaga = " . $_POST['cod_vaga'];

if ($conn->query($sql) === TRUE) {
    $msg = 'Vaga atualizada com sucesso!';
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>