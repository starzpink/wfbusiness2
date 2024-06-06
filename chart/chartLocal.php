<?php
include '../conn.php';

$total = mysqli_fetch_array($conn->query("select count(*) from local_trabalho"));
$sql = "select cidade_local, count(cod_emp) total from local_trabalho, empresa where local_trabalho.cod_local = 
empresa.cod_local group by local_trabalho.cod_local";
$result = $conn->query($sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$conn->close();
header("Content-type: application/json");
echo json_encode(['data' => $rows]);
?>