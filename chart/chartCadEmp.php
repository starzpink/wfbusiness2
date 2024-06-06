<?php
include '../conn.php';

$total = mysqli_fetch_array($conn->query("select count(*) from areaat"));
$sql = "SELECT nome_emp, DATE_FORMAT(data_registro_emp, '%d-%m-%Y') as data_registro FROM empresa ORDER BY data_registro_emp";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

echo json_encode(['data' => $data]);
?>