<?php
include '../conn.php';
session_start();

// Verifica se o usuário está logado e se a sessão 'cod_emp' está definida
if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401); // Não autorizado
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

$cod_emp = isset($_SESSION['cod_emp']) ? $_SESSION['cod_emp'] : null;

if ($cod_emp === null) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Código da empresa não definido.']);
    exit;
}

// Paginação
$ini = isset($_GET['page']) ? ($_GET['page'] - 1) * 10 : 0;

// Conta o total de registros
$stmt_total = $conn->prepare("SELECT COUNT(*) FROM vaga WHERE cod_emp = ?");
$stmt_total->bind_param("i", $cod_emp);
$stmt_total->execute();
$total_result = $stmt_total->get_result();
$total = $total_result->fetch_array()[0];

// Busca os registros paginados
$stmt = $conn->prepare("SELECT * FROM vaga WHERE cod_emp = ? LIMIT ?, 10");
$stmt->bind_param("ii", $cod_emp, $ini);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

// Define o cabeçalho do conteúdo como JSON e retorna os dados
header("Content-type: application/json");
echo json_encode(['data' => $rows, 'total' => (int)$total]);
?>
