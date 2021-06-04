<?php

function deleteUser($user_id){
    global $conn;

    if (isset($_GET['delete'])){
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: users.php");
    }
}

function deleteProduct(){
    global $conn;

    if (isset($_GET['delete'])){
        $delete_product_by_id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $delete_product_by_id);
        $stmt->execute();
        $stmt->close();
        header("Location: products.php");
    }
}

function deleteCountry(){
    global $conn;

    if (isset($_GET['delete'])){
        $delete_country_by_id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM countries WHERE country_id = ?");
        $stmt->bind_param("i", $delete_country_by_id);
        $stmt->execute();
        $stmt->close();
        header("Location: countries.php");
    }
}