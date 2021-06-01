<?php

function deleteTask($user_id){
    global $conn;

    if (isset($_GET['delete'])){
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: users.php");
    }
}