<?php
if (isset($_POST['create_user'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];
    $user_editedDate = date('Y-m-d');
    $user_createdDate = date('Y-m-d');

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (isset($conn)) {
        $stmt = $conn->prepare("INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_editedDate, user_createdDate) VALUES(?, ?, ?, ?, ?, ?, ?, now(), now())");
        $stmt->bind_param("sssssss", $user_username, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role);
        $stmt->execute();
        $stmt->close();
        header("Location: users.php"); // burde muligvis være i en if() ?
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username:</label>
        <input type="text" class="form-control" name="user_username">
    </div>

    <div class="form-group">
        <label for="user_password">Password:</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">Firstname:</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname:</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email:</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <br/>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="status">Role:</label>
        <br/>
        <select class="form-control" name="user_role" id="user_role">
            <option value="user">User</option>
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create user">
    </div>
</form>