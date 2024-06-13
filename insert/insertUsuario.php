<?php
session_start();

include '../conn.php';

header('Content-type: application/json');

// Verifica se os campos esperados estão definidos em $_POST
if(isset($_POST['email'], $_POST['senha'], $_POST['cargo'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];
    
    // Inserir usuário na tabela 'usuario'
    $sql = "INSERT INTO usuario (email, senha, cargo) "
            . "VALUES ('$email', MD5('$senha'), $cargo)";
    
    if($conn->query($sql) === TRUE){
        $cod_usuario = $conn->insert_id;
        $conn->query("SET @cod_usuario = $cod_usuario");
        $msg = "Usuário adicionado com sucesso!";
    } else {
        $msg = "Erro ao inserir usuário: ".$conn->error;
    }
} else {
    $msg = "Campos obrigatórios não foram enviados.";
}

$conn->close();

echo json_encode(['msg'=>$msg]);
?>