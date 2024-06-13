<?php
session_start();
$cod_usuario = $_SESSION['cod_usuario'];

include './bd/conn.php';

$conn->query("SET @cod_usuario = $cod_usuario");

header('Content-type: application/json');

$sql = "INSERT INTO vaga (titulo_vaga, descricao_vaga, salario_vaga, cod_local, cod_mod, cod_tipo, horario_vaga, situacao_vaga, cod_emp) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssiiissi",
    $_POST['titulo_vaga'],
    $_POST['descricao_vaga'],
    $_POST['salario_vaga'],
    $_POST['cod_local'],
    $_POST['cod_mod'],
    $_POST['cod_tipo'],
    $_POST['horario_vaga'],
    $_POST['situacao_vaga'],
    $_SESSION['cod_emp']
);

if ($stmt->execute() === TRUE) {
    $msg = "Vaga adicionada com sucesso!";
} else {
    $msg = "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
echo json_encode(['msg' => $msg]);
?>