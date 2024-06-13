<?php
include './bd/conn.php';
session_start();
$cod_emp = $_SESSION['cod_emp'];

$ini = isset($_GET['page']) ? ($_GET['page'] - 1) * 10 : 0;

$total = mysqli_fetch_array($conn->query('select count(*) from rh where cod_emp=' . $cod_emp));
$sql = ' select * from rh where cod_emp=' . $cod_emp . ' limit ' . $ini . ', 10';
$result = $conn->query($sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();

header("Content-type: application/json");
echo json_encode(['data' => $rows, "total" => $total[0]]);
?>