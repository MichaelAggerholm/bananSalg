<?php
if (isset($_GET['p_id'])){
    $the_product_id = $_GET['p_id'];
}

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("s", $the_product_id);
$stmt->execute();
$select_products_by_id = $stmt->get_result();
$stmt->close();

while ($row = mysqli_fetch_assoc($select_products_by_id)) {
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_image = $row['product_image'];
    $product_price = $row['product_price'];
    $product_status = $row['product_status'];
    $product_category_id = $row['product_category_id'];
    $product_country_id = $row['product_country_id'];
}

if (isset($_POST['update_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp = $_FILES['product_image']['tmp_name'];
    $product_rating = $_POST['product_rating'];
    $product_price = $_POST['product_price'];
    $product_status = $_POST['product_status'];
    $product_category_id = $_POST['product_category_id'];
    $product_country_id = $_POST['product_country_id'];
    $product_editedDate = date('Y-m-d');

    move_uploaded_file($product_image_temp, "../images/$product_image");

    if (empty($product_image)){
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $the_product_id);
        $stmt->execute();
        $select_image = $stmt->get_result();
        $stmt->close();

        while($row = mysqli_fetch_array($select_image)){
            $product_image = $row['product_image'];
        }
    }

    $stmt = $conn->prepare("UPDATE products SET product_title = ?, product_description = ?, product_image = ?, product_rating = ?, product_price = ?, product_status = ?, product_category_id = ?, product_country_id = ?, product_editedDate = now() WHERE product_id = ?");
    $stmt->bind_param("sssidsiii", $product_title, $product_description, $product_image, $product_rating, $product_price, $product_status, $product_category_id, $product_country_id, $the_product_id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_title">Title:</label>
        <input type="text" value='<?php echo $product_title; ?>' class="form-control" name="product_title">
    </div>

    <div class="form-group">
        <label for="product_description">Description:</label>
        <textarea class="form-control" name="product_description" id="summernote"><?php echo $product_description; ?></textarea>
    </div>

    <div class="form-group">
        <label for="product_image">Image:</label>
        <br/>
        <img style="width: 300px;" src="../images/<?php echo $product_image; ?>" />
        <br/><br/>
        <input type="file" name="product_image">
    </div>

<!--    BURDE IKKE VÆRE MED!!!!!!!-->
    <div class="form-group">
        <label for="product_rating">Rating:</label>
        <br/>
        <select class="form-control" name="product_rating" id="product_rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <!--    BURDE IKKE VÆRE MED!!!!!!!-->

    <div class="form-group">
<!--        SHOULD MAYBE NOT BE TEXT?!-->
        <label for="product_price">Price:</label>
        <input type="text" value='<?php echo $product_price; ?>' class="form-control" name="product_price">
    </div>

    <div class="form-group">
        <label for="product_status">Status:</label>
        <br/>
        <select class="form-control" name="product_status" id="product_status">
            <?php
            $options = array('active', 'draft', 'expired');
            foreach($options as $opt) {
                $selected = ($product_status == $opt) ? 'selected' : '';
                echo '<option value="' . $opt . '" ' . $selected . '>' . ucfirst($opt) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_category_id">Category:</label>
        <br/>
        <select class="form-control" name="product_category_id" id="product_category_id">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($conn, $query);

            //    queryChecker($select_all_projects);

            while($row = mysqli_fetch_assoc($select_categories)){
                $category_id     = $row['category_id'];
                $category_title  = $row['category_title'];

                $selected = ($category_id == $product_category_id) ? 'selected' : '';
                echo "<option value='{$category_id}' {$selected}>{$category_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_country_id">Country:</label>
        <br/>
        <select class="form-control" name="product_country_id" id="product_country_id">
            <?php
            $query = "SELECT * FROM countries";
            $select_countries = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($select_countries)){
                $country_id     = $row['country_id'];
                $country_title  = $row['country_title'];

                $selected = ($country_id == $product_country_id) ? 'selected' : '';
                echo "<option value='{$country_id}' {$selected}>{$country_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_product" value="Update product">
    </div>
</form>