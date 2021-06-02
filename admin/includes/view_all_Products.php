<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Rating</th>
        <th>Price</th>
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
                <td>$product_rating</td>
                <td>$product_price</td>
                <td>$product_category_id</td>
                <td>$product_country_id</td>
                <td>$product_editedDate</td>
                <td>$product_createdDate</td>
                <td><a class="btn btn-primary" href='products.php?source=edit_product&p_id={$product_id}'>Edit</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {$product_title}?');" href='products.php?delete={$product_id}'>Delete</a></td>
            </tr>
        USERS_ONE;
    }

    // Delete user
    deleteProduct($product_id);
    ?>
    </tbody>
</table>