<?php

include '../conn.php';

$ini = isset($_GET['page']) ? ($_GET['page'] - 1) * 10 : 0;

$total = mysqli_fetch_array($conn->query('select count(*) from tipo_vaga'));
$sql = ' select * from tipo_vaga limit ' . $ini . ', 10';
$result = $conn->query($sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();

header('Content-type: application/json');
echo json_encode(['data' => $rows, 'total' => $total[0]]);
?>
