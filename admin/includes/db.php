<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "banan_salg";

$conn = new mysqli($db_host, $db_username ,$db_password ,$db_name);
if($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$create_users = "CREATE TABLE IF NOT EXISTS users (
user_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_username VARCHAR(255) NOT NULL,
user_password VARCHAR(255) NOT NULL,
user_firstname VARCHAR(255) NOT NULL,
user_lastname VARCHAR(255) NOT NULL,
user_email VARCHAR(255) NOT NULL,
user_image TEXT,
user_role VARCHAR(255) NOT NULL,
user_randSalt TEXT,
user_editedDate DATE NOT NULL,
user_createdDate DATE NOT NULL
)";
$create_users_table = $conn->query($create_users);

$user_username = 'admin';
$user_password = 'wysiwyg';
$user_firstname = 'Adminnar';
$user_lastname = 'Adminson';
$user_email = 'admin@banasalg.dk';
$user_image = 'none';
$user_role = 'admin';
$user_randSalt = 'none';

$query = "SELECT count(*) AS count FROM users";
$result = mysqli_query($conn, $query);
$users_count_array = mysqli_fetch_assoc($result);

if ($users_count_array['count'] <= 0){
    $stmt = $conn->prepare("INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_randSalt, user_editedDate, user_createdDate) VALUES(?, ?, ?, ?, ?, ?, ?, ?, now(), now())");
    $stmt->bind_param('ssssssss', $user_username, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $user_randSalt);
    $stmt->execute();
    $stmt->close();
}
//else {
//    echo $users_count_array['count'];
//}

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//$conn->set_charset("utf8mb4");
?>