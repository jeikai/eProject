<?php
    include './component/header.php';
    $error = '';
    if( !isset( $_GET['edit'])) {
        header('Location: ./upload_san_pham.php');
    }
    $edit_id = $_GET['edit'];
    if ( isset($_POST['update_product'])) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_image = $_POST['update_image'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $sql = "UPDATE Products SET productName = '$update_name'";
        $connection->prepare( $sql )->execute();
        header('Location: ./upload_san_pham.php');
    }
?>

    <?php 
    $sql_update = "SELECT * FROM Products WHERE productId = $edit_id";
    try {        
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $statement = $connection->prepare($sql_update);
        $statement->execute();
        $statement->setFetchMode ( PDO::FETCH_ASSOC);
        $product = $statement->fetchAll();
        foreach ( $product as $product) {
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <img src="./Ảnh_sp/<?php echo $product['imageUrls']?>" alt="" height="200">
        <input type="hidden" name="update_id" value="<?php echo $product['productId']?>" id="">
        <input type="text" class="box" name="update_name" value="<?php echo $product['productName'];?>" id="">
        <input type="number" min="0" class="box" required name="update_weight" value="<?php echo $product['weight'];?>">
        <input type="text" class="box" name="update_color" value="<?php echo $product['color'];?>" id="">
        <input type="text" class="box" name="update_brand" value="<?php echo $product['brand'];?>" id="">
        <input type="number" min="0" class="box" required name="update_price" value="<?php echo $product['price'];?>">
        <input type="file" class="box" required name="update_image" accept="image/png, image/jpg, image/jpeg">
        <input type="submit" value="Update" name="update_product" class="btn" id="">
        <input type="reset" value="Cancel" class="option-btn">
    </form>
    <?php
        }
        echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
        } catch(PDOException $e) {
            echo "Cannot execute sql: " . $e->getMessage();
        }
    ?>

<?php
    include './component/footer.php';
?>