<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Last edited</th>
        <th>Created</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Find all users query
    $query = "SELECT * FROM users ORDER BY user_id ASC";
    if (isset($conn)){
        $select_all_users = mysqli_query($conn, $query);
    }

    while ($row = mysqli_fetch_assoc($select_all_users)){
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_editedDate = $row['user_editedDate'];
        $user_createdDate = $row['user_createdDate'];

        echo <<<USERS_ONE
            <tr>
                <td>$user_id</td>
                <td>$user_username</td>
                <td>$user_firstname</td>
                <td>$user_lastname</td>
                <td>$user_email</td>
                <td><img style="width:50px;" src='../images/$user_image' alt="User image" /></td>
                <td>$user_role</td>
                <td>$user_editedDate</td>
                <td>$user_createdDate</td>
                <td><a class="btn btn-primary" href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {$user_username}?');" href='users.php?delete={$user_id}'>Delete</a></td>
            </tr>
        USERS_ONE;
    }

    // Delete user
    deleteUser($user_id);
    ?>
    </tbody>
</table>