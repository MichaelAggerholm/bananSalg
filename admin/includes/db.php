<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "banan_salg";

$conn = new mysqli($db_host, $db_username ,$db_password ,$db_name);
if($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//$conn->set_charset("utf8mb4");
?>