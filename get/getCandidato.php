<?php
include '../conn.php';
session_start();

// Sanitize and validate 'cod_vaga'
$cod_vaga = isset($_GET['cod_vaga']) ? intval($_GET['cod_vaga']) : 0;
if ($cod_vaga <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid job code']);
    exit;
}

// Sanitize and validate 'page'
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page <= 0) {
    $page = 1;
}

$ini = ($page - 1) * 10;

try {
    // Fetch total count of candidates for the job
    $total_result = $conn->query('SELECT COUNT(*) as total FROM candidato WHERE cod_vaga=' . $cod_vaga);
    if (!$total_result) {
        throw new Exception('Error executing count query: ' . $conn->error);
    }
    $total = $total_result->fetch_assoc()['total'];

    // Fetch the candidates for the current page
    $sql = 'SELECT * FROM candidato WHERE cod_vaga=' . $cod_vaga . ' LIMIT ' . $ini . ', 10';
    $result = $conn->query($sql);
    if (!$result) {
        throw new Exception('Error executing data query: ' . $conn->error);
    }

    $rows = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    $conn->close();
    exit;
}

$conn->close();

header("Content-Type: application/json");
echo json_encode(['data' => $rows, 'total' => $total]);
?>