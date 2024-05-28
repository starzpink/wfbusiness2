<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workfolio_business";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão:" . $conn->connect_error);
}
?>

