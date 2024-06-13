<?php
include '../conn.php';
session_start();

// Verifica se o usuário está logado e se a sessão 'cod_emp' está definida
if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401); // Não autorizado
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];
$cod_emp = isset($_SESSION['cod_emp']) ? $_SESSION['cod_emp'] : null;

$sql = "SELECT modalidade.desc_mod, COUNT(vaga.cod_vaga) AS total 
FROM modalidade 
JOIN vaga ON vaga.cod_mod = modalidade.cod_mod
WHERE vaga.cod_emp = ?
GROUP BY modalidade.desc_mod";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cod_emp);
$stmt->execute();
$result = $stmt->get_result();
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();

// Define o cabeçalho do conteúdo como JSON e retorna os dados
header("Content-type: application/json");
echo json_encode(['data' => $rows]);
?>