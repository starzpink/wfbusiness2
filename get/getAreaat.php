<?php
include '../conn.php';

// Default to page 1 if 'page' parameter is not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$ini = ($page - 1) * 10;

// Fetch total count of records
$totalResult = $conn->query('SELECT COUNT(*) as count FROM areaat');
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['count'];

// Fetch records for the current page
$sql = 'SELECT * FROM areaat LIMIT ' . $ini . ', 30';
$result = $conn->query($sql);

// Fetch rows
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
$conn->close();

// Return data as JSON
header('Content-type: application/json');
echo json_encode(['data' => $rows, 'total' => $total]);
?>