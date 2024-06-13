<?php
include '../conn.php';
session_start();

if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401); // Não autorizado
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];
$cod_emp = isset($_SESSION['cod_emp']) ? $_SESSION['cod_emp'] : null;

$sql = "SELECT titulo_vaga, COUNT(cod_vaga) AS total 
        FROM vaga 
        WHERE vaga.cod_emp = ? 
        GROUP BY vaga.titulo_vaga";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cod_emp);
$stmt->execute();
$result = $stmt->get_result();
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();

header("Content-type: application/json");
echo json_encode(['data' => $rows]);
?>