<?php
session_start();
include '../conn.php';

$cod_usuario = $_SESSION['cod_usuario'];

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$titulo_vaga = $_POST['titulo_vaga'];
$descricao_vaga = $_POST['descricao_vaga'];
$salario_vaga = $_POST['salario_vaga'];
$cod_local = $_POST['cod_local'];
$cod_mod = $_POST['cod_mod'];
$cod_tipo = $_POST['cod_tipo'];
$horario_vaga = $_POST['horario_vaga'];
$situacao_vaga = 'Aberta'; // Supondo que todas as vagas inseridas estão inicialmente abertas
$cod_emp = $_SESSION['cod_emp'];

$sql = "INSERT INTO vaga (titulo_vaga, descricao_vaga, salario_vaga, cod_local, cod_mod, cod_tipo, horario_vaga, situacao_vaga, cod_emp) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdiisiis", $titulo_vaga, $descricao_vaga, $salario_vaga, $cod_local, $cod_mod, $cod_tipo, $horario_vaga, $situacao_vaga, $cod_emp);

if ($stmt->execute() === TRUE) {
    $msg = "Vaga adicionada com sucesso!";
} else {
    $msg = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode(['msg' => $msg]);
?>
