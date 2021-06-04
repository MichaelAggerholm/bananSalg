<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Rating</th>
        <th>Price</th>
        <th>Status</th>
        <th>Category</th>
        <th>Country</th>
        <th>Last edited</th>
        <th>Created</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Find all users query
    $query = "SELECT * FROM products ORDER BY product_id DESC";
    if (isset($conn)){
        $select_all_products = mysqli_query($conn, $query);
    }

    while ($row = mysqli_fetch_assoc($select_all_products)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $product_rating = $row['product_rating'];
        $product_price = $row['product_price'];
        $product_status = $row['product_status'];
        $product_category_id = $row['product_category_id'];
        $product_country_id = $row['product_country_id'];
        $product_editedDate = $row['product_editedDate'];
        $product_createdDate = $row['product_createdDate'];


        echo <<<USERS_ONE
            <tr>
                <td>$product_id</td>
                <td>$product_title</td>
                <td>$product_description</td>
                <td><img style="width:50px;" src='../images/$product_image' alt="Product image" /></td>
                <td>$product_rating / 5</td>
                <td>$product_price Kr.-</td>
                <td>$product_status</td>
        USERS_ONE;

        $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $product_category_id);
        $stmt->execute();
        $get_categories_by_id = $stmt->get_result(); // get the mysqli result
        $stmt->close();

        while($row = mysqli_fetch_assoc($get_categories_by_id)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];

            echo "<td>{$category_title}</td>";
        }

        $stmt = $conn->prepare("SELECT * FROM countries WHERE country_id = ?");
        $stmt->bind_param("i", $product_country_id);
        $stmt->execute();
        $get_countries_by_id = $stmt->get_result(); // get the mysqli result
        $stmt->close();

        while($row = mysqli_fetch_assoc($get_countries_by_id)) {
            $country_id = $row['country_id'];
            $country_title = $row['country_title'];

            echo "<td>{$country_title}</td>";
        }

        echo <<<USERS_TWO
                <td>$product_editedDate</td>
                <td>$product_createdDate</td>
                <td><a class="btn btn-primary" href='products.php?source=edit_product&p_id={$product_id}'>Edit</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete $product_title');" href='products.php?delete={$product_id}'>Delete</a></td>
            </tr>
        USERS_TWO;
    }

    // Delete user
    deleteProduct();
    ?>
    </tbody>
</table>