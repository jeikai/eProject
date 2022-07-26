<?php
    include './component/header.php';
    if ( $_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "DELETE FROM Products WHERE productId=".$_POST['productId'] ;
        $connection->prepare( $sql )->exec();
        header('Location: ./upload_san_pham.php');
    } else {
        if( !isset($_GET['productId']) ) {
            header('Location: ./upload_san_pham.php');
        }
        $id = $_GET['productId'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Product</title>
    
</head>
<body>
    <?php
            $sql = "SELECT * FROM Products where productId=".$id;
            global $connection;
            $statement = $connection->prepare($sql); 
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $sp = $statement->fetchAll();
            foreach ( $sp as $sp) {
                
        ?>
    <h1>Are you sure want to delete this product?</h1>
    <table border="1px" width="100%" cellspacing="0" cellpadding="5px" >
        
        <tbody style="text-align: center;">
            <tr>
                <td>ID</td>
                <td><?php echo $sp['productId'];?></td>
            </tr>
            <tr>
                <td>Tên sản phẩm</td>
                <td><?php echo $sp['productName'];?></td>
            </tr> 
            <tr>
                <td>Cân nặng</td>
                <td><?php echo $sp['weight'];?></td>
            </tr> 
            <tr>
                <td>Màu sắc</td>
                <td><?php echo $sp['color'];?></td>
            </tr> 
            <tr>
                <td>Phân loại</td>
                <td><?php echo $sp['categoryId'];?></td>
            </tr> 
            <tr>
                <td>Ảnh sản phẩm</td>
                <td><img style="width: 100px;" src="./Ảnh_sp/<?php echo $sp['imageUrls'];?>" ></td>
            </tr>
            <tr>
                <td>Thương hiệu</td>
                <td><?php echo $sp['brand'];?></td>
            </tr>
            <tr>
                <td>Giá bán</td>
                <td><?php echo $sp['price'];?></td>
            </tr>
       
        </tbody>
    </table>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $user['userId']; ?>" >
        
        <input type="submit" name="submit" value="Delete Book" class="btn-primary">
    </form>
     <?php
            }
        ?>
</body>
<?php
    require_once('./component/footer.php');
?>