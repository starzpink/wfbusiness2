<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include '../conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

// Prepare and bind
$stmt = $conn->prepare("UPDATE vaga SET 
    titulo_vaga = ?, 
    descricao_vaga = ?, 
    salario_vaga = ?, 
    cod_local = ?, 
    cod_mod = ?, 
    cod_tipo = ?, 
    horario_vaga = ?, 
    situacao_vaga = ?, 
    cod_emp = ?
    WHERE cod_vaga = ?");

$stmt->bind_param("sssiiiiisi", $titulo_vaga, $descricao_vaga, $salario_vaga, $cod_local, $cod_mod, $cod_tipo, $horario_vaga, $situacao_vaga, $cod_emp, $cod_vaga);

// Set parameters and execute
$cod_vaga = $_POST['cod_vaga'];
$titulo_vaga = $_POST['titulo_vaga'];
$descricao_vaga = $_POST['descricao_vaga'];
$salario_vaga = $_POST['salario_vaga'];
$cod_local = $_POST['cod_local'];
$cod_mod = $_POST['cod_mod'];
$cod_tipo = $_POST['cod_tipo'];
$horario_vaga = $_POST['horario_vaga'];
$situacao_vaga = $_POST['situacao_vaga'];
$cod_emp = $_SESSION['cod_emp'];

if ($stmt->execute()) {
    $msg = 'Vaga atualizada com sucesso!';
} else {
    $msg = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode(['msg' => $msg]);
?>