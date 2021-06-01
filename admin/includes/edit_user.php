<?php
if (isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];
}

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("s", $the_user_id);
$stmt->execute();
$select_users_by_id = $stmt->get_result();
$stmt->close();

while ($row = mysqli_fetch_assoc($select_users_by_id)) {
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}

if (isset($_POST['update_user'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)){
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("s", $the_user_id);
        $stmt->execute();
        $select_image = $stmt->get_result();
        $stmt->close();

        while($row = mysqli_fetch_array($select_image)){
            $user_image = $row['user_image'];
        }
    }

    $stmt = $conn->prepare("UPDATE users SET user_username = ?, user_password = ?, user_firstname = ?, user_lastname = ?, user_email = ?, user_role = ?, user_image = ?, user_editedDate = now() WHERE user_id = ?");
    $stmt->bind_param("sssssssi", $user_username, $user_password, $user_firstname, $user_lastname, $user_email, $user_role, $user_image, $the_user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: users.php"); // burde muligvis være i et if statement.
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" value='<?php echo $user_username; ?>' class="form-control" name="user_username">
    </div>

    <div class="form-group">
        <label for="username">Password:</label>
        <input type="password" value='<?php echo $user_password; ?>' class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname:</label>
        <input type="text" value='<?php echo $user_firstname; ?>' class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="author">Lastname:</label>
        <input type="text" value='<?php echo $user_lastname; ?>' class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="author">Email:</label>
        <input type="text" value='<?php echo $user_email; ?>' class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <br/>
        <img style="width: 300px;" src="../images/<?php echo $user_image; ?>" />
        <br/><br/>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="status">Role:</label>
        <br/>
        <select class="form-control" name="user_role" id="user_role">
            <?php
            $options = array('user', 'subscriber', 'admin');
            foreach($options as $opt) {
                $selected = ($user_role == $opt) ? 'selected' : '';
                echo '<option value="' . $opt . '" ' . $selected . '>' . ucfirst($opt) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
    </div>
</form>