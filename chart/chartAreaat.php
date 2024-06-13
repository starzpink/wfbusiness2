<?php
include './bd/conn.php';

$total = mysqli_fetch_array($conn->query("select count(*) from areaat"));

$sql = "select desc_area, count(cod_emp) total from areaat, empresa where areaat.cod_area = 
empresa.areaat_emp group by areaat.cod_area";

$result = $conn->query($sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();
header("Content-type: application/json");
echo json_encode(['data' => $rows]);
?>