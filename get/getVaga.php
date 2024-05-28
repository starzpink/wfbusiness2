<?php
include '../conn.php';

$ini = isset($_GET['page'])?($_GET['page']-1)*10:0;
$rh = isset($_POST['cod_rh'])?$_POST['cod_rh']:'';
$emp = isset($_POST['cod_emp'])?$_POST['cod_emp']:'';

$total = mysqli_fetch_array($conn->query("select count(*) from vaga where cod_emp = ".$emp.""));

$sql = ' select * from vaga where cod_emp = ' . $emp . 'limit ' . $ini . ', 10';
$result = $conn->query($sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();

header("Content-type: application/json");
echo json_encode(['data'=>$rows,"total" => $total[0]]);
?>

