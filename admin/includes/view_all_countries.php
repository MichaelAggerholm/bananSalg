<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Last edited</th>
        <th>Created</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Find all countries query
    $query = "SELECT * FROM countries ORDER BY country_id DESC";
    if (isset($conn)){
        $select_all_countries = mysqli_query($conn, $query);
    }

    while ($row = mysqli_fetch_assoc($select_all_countries)){
        $country_id = $row['country_id'];
        $country_title = $row['country_title'];
        $country_editedDate = $row['country_editedDate'];
        $country_createdDate = $row['country_createdDate'];

        echo <<<COUNTRIES_ONE
            <tr>
                <td>$country_id</td>
                <td>$country_title</td>
                <td>$country_editedDate</td>
                <td>$country_createdDate</td>
                <td><a class="btn btn-primary" href='countries.php?source=edit_country&p_id={$country_id}'>Edit</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete $country_title');" href='countries.php?delete={$country_id}'>Delete</a></td>
            </tr>
        COUNTRIES_ONE;
    }

    // Delete user
    deleteCountry();
    ?>
    </tbody>
</table>