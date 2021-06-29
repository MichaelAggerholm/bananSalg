<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "banan_salg";

$conn = new mysqli($db_host, $db_username ,$db_password ,$db_name);
if($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$create_countries = "CREATE TABLE IF NOT EXISTS countries (
country_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
country_title VARCHAR(255) NOT NULL,
category_editedDate DATE NOT NULL,
category_createdDate DATE NOT NULL
)";
$create_countries_table = $conn->query($create_countries);

$create_categories = "CREATE TABLE IF NOT EXISTS categories (
category_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
category_title VARCHAR(255) NOT NULL,
category_description VARCHAR(255) NOT NULL,
category_image TEXT NOT NULL,
category_rating SMALLINT(5) NOT NULL,
category_editedDate DATE NOT NULL,
category_createdDate DATE NOT NULL
)";
$create_categories_table = $conn->query($create_categories);

$create_products = "CREATE TABLE IF NOT EXISTS products (
product_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product_title VARCHAR(255) NOT NULL,
product_description VARCHAR(255) NOT NULL,
product_image TEXT NOT NULL,
product_rating SMALLINT(5) NOT NULL,
product_price DECIMAL(10,0) NOT NULL,
product_status VARCHAR(255) NOT NULL,
product_category_id INT(3) NOT NULL,
product_country_id INT(3) NOT NULL,
product_editedDate DATE NOT NULL,
product_createdDate DATE NOT NULL
)";
$create_products_table = $conn->query($create_products);

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
