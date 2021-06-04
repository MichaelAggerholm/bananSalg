<?php
if (isset($_POST['create_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp = $_FILES['product_image']['tmp_name'];
    $product_price = $_POST['product_price'];
    $product_status = $_POST['product_status'];
    $product_category_id = $_POST['product_category_id'];
    $product_country_id = $_POST['product_country_id'];
    $product_editedDate = date('Y-m-d');
    $product_createdDate = date('Y-m-d');

    move_uploaded_file($product_image_temp, "../images/$product_image");

    $stmt = $conn->prepare("INSERT INTO products(product_title, product_description, product_image, product_rating, product_price, product_status, product_category_id, product_country_id, product_editedDate, product_createdDate) VALUES(?, ?, ?, 0, ?, ?, ?, ?, now(), now())");
    $stmt->bind_param("sssdsii", $product_title, $product_description, $product_image, $product_price, $product_status, $product_category_id, $product_country_id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");

}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_title">Title:</label>
        <input type="text" class="form-control" name="product_title">
    </div>

    <div class="form-group">
        <label for="product_image">Image:</label>
        <br/>
        <input type="file" name="product_image">
    </div>

    <div class="form-group">
        <label for="product_price">Price:</label>
        <input type="text" class="form-control" name="product_price">
    </div>

    <div class="form-group">
        <label for="product_status">Status:</label>
        <br/>
        <select class="form-control" name="product_status" id="product_status">
            <option value="active">Active</option>
            <option value="draft">Draft</option>
            <option value="expired">Expired</option>
        </select>
    </div>

    <div class="form-group">
        <label for="product_category_id">Category:</label>
        <br/>
        <select class="form-control" name="product_category_id" id="product_category_id">
            <?php
            $stmt = $conn->prepare("SELECT * FROM categories");
            $stmt->execute();
            $get_categories = $stmt->get_result();
            $stmt->close();

            while($row = mysqli_fetch_assoc($get_categories)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];

                echo "<td>{$category_title}</td>";
                echo "<option value='{$category_id}'>{$category_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_country_id">Country:</label>
        <br/>
        <select class="form-control" name="product_country_id" id="product_country_id">
            <?php
            $stmt = $conn->prepare("SELECT * FROM countries");
            $stmt->execute();
            $get_countries = $stmt->get_result();
            $stmt->close();

            while($row = mysqli_fetch_assoc($get_countries)) {
                $country_id = $row['country_id'];
                $country_title = $row['country_title'];

                echo "<option value='{$country_id}'>{$country_title}</option>";
             }
             ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_description">Description:</label>
        <textarea class="form-control" name="product_description" id="summernote"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_product" value="Create product">
    </div>
</form>