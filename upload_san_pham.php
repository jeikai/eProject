<?php
    include './component/header_as_admin.php';

    $imgUrls = ""; 
    $productName = htmlspecialchars( $_POST['productName'] ?? '');
    $weight = htmlspecialchars( $_POST['weight'] ?? '');
    $color = htmlspecialchars( $_POST['color'] ?? '');
    $categoryName = htmlspecialchars( $_POST['categoryName'] ?? '');
    $price = htmlspecialchars( $_POST['price'] ?? '');
    $brand = htmlspecialchars( $_POST['brand'] ?? '');
    $gender = htmlspecialchars( $_POST['gender'] ?? '');
    $check = false;
    $productId = time();
    if ( isset($_POST['submit'])) {
        //Kiểm duyệt file ảnh
        $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        //Tên file
        $file_name = $_FILES['imgUrls']['name'];
        if( !empty( $file_name )) {
            
            //Nơi nguồn
            $file_tmp_name = $_FILES['imgUrls']['tmp_name'];
 
            //nơi đích chứa file được upload lên
            $destination = "./Ảnh_sp/${file_name}";
            $imgUrls = $file_name;
            
            //Lấy ra đuôi file bằng hàm explode
            //Khi gặp dấu chấm, hàm sẽ tách chuỗi đó ra
            //end: lấy phần tử cuối trong mảng
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));

            //Kiểm tra tên file
            if ( in_array($file_extension, $permitted_extensions)) {
                    $check = true;
                    
            } else {
                $error_message = 'Invalid file type';
            }
        if ( empty($productName) || empty($weight) || empty($color) || empty($categoryName) || empty($price) || empty($brand)) {
            $error_message = "You must enter name, weight, color, category, brand and price.";
        } else {
            if ( $connection != NULL) {
                $sql = "SELECT COUNT(*) AS count FROM Products WHERE productName='$productName' AND weight='$weight' AND color='$color' AND categoryName='$categoryName' AND price='$price' AND brand='$brand' ";            
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql); 
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC); 
                //Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
                if(intval($statement->fetchAll()[0]['count']) > 0) {
                    $error_message = "Sản phẩm đã tồn tại";
                } else {
                    //ok to insert
                    if ($check ) {
                        //Upload file từ nơi nguồn lên đích là destination
                        move_uploaded_file($file_tmp_name, $destination);
                        
                    }
                        $sql = "INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,  imageUrls, brand) 
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";                    
                        $connection->prepare($sql)->execute([$productId, $weight, $color, $price, $productName, $categoryName,$gender, $imgUrls, $brand]);
                        $error_message = '<p style= "color: green;">Thêm sản phẩm thành công</p>';
                };
            } catch(PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
            }
        }
        } else {
            $error_message = 'No such file selected';
        }
 
    }
    if ( isset( $_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $sql = "DELETE FROM Products WHERE productId = $delete_id";
        $connection->prepare($sql)->execute();
        header('Location: ./upload_san_pham.php');
    }
?>
<head>
    <link rel="stylesheet" href="./css/upload_san_pham.css">
</head>
<h1 style="text-align: center;">Bảng upload sản phẩm</h1>
<hr>
<div  style="margin-left: 300px;" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
        <table style="width: 50%;height: 300px;">
            <tr>
                <td>Tên sản phẩm: </td>
                <td><input type="text" name="productName" id="" require placeholder="Your product name"></td>      
            </tr>
            <tr>
                <td>Cân nặng: </td>
                <td><input type="number" name="weight" id="" min=0 require placeholder="Your product size"></td>
            </tr>
            <tr>
                <td>Màu sắc: </td>
                <td><input type="text" name="color" id="" require placeholder="Your product color"></td>
            </tr>
            <tr>
                <td>Phân loại: </td>
                <td>
                    <input type="text" name="categoryName" list="listdata" require placeholder="Your type">
                    <datalist id="listdata">
                            <option value="adult">ADULT</option>
                            <option value="children">CHILDREN</option>
                            <option value="teenager">TEENAGER</option>
                    </datalist> 
                </td>
            </tr>
            <tr>
                <td>Giới tính: </td>
                <td>
                    <select name="gender" id="">
                        <option value="male" selected>Nam</option>
                        <option value="female" >Nữ</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Thương hiệu: </td>
                <td>
                    <input type="text" name="brand" id="data" placeholder="Brand name">
                    <datalist id="data">
                            <option >VICTORINOX</option>
                            <option >SAMONITE</option>
                            <option >HUBLOT</option>
                            <option >FOSSIL</option>
                            <option >FENDI</option>
                            <option >LIPAULT</option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm:<br>(Tối đa 5 ảnh)</td>
                <td>
                    <input type="file" name="imgUrls" require >
                </td>

            </tr>
            <tr>
                <td>Giá bán: </td>
                <td><input type="number" name="price" id="" require placeholder="Price of your product"></td>
            </tr>
        </table>
        
        <input type="submit" value="submit" name="submit" class="btn-lg">
    </form>
    <p style= "color: red;"><?php echo $error_message ?? '' ?></p>
</div>
<caption ><h2 class="title">Sản phẩm đã đăng</h2></caption>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px" >
    
    <thead align="center">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Cân nặng</th>
        <th>Màu sắc</th>
        <th>Giới tính</th>
        <th>Phân loại</th>
        <th>Thương hiệu</th>
        <th>Ảnh sản phẩm</th>
        <th>Giá bán</th>
        <th></th>
    </tr>
    </thead>
    <tbody align="center">
    <?php
        
        $sql = "SELECT * FROM Products";
        $statement = $connection->prepare($sql);
        $statement->execute();
        //Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
        $sp = $statement->fetchAll();
        foreach( $sp as $sp) {
    ?>
    <tr>
        <td><?php echo $sp['productId'];?></td>
        <td><?php echo $sp['productName'];?></td>
        <td><?php echo $sp['weight'];?>kg</td>
        <td><?php echo $sp['color'];?></td>
        <td><?php echo $sp['gender']?></td>
        <td><?php echo $sp['categoryName'];?></td>
        <td><?php echo $sp['brand'];?></td>
        <td><img style="width: 100px;" src="./Ảnh_sp/<?php echo $sp['imageUrls'];?>"></td>
        <td><?php echo $sp['price'];?>$</td>
        <td><a  href="./<?php echo 'upload_san_pham.php?delete='.$sp['productId'];?>" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i>Delete</a></td>
        <td><a href="./<?php echo 'update.php?edit='.$sp['productId'];?>"><i class="fas fa-edit"></i>Update</a></td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>
</body>
</html>
    
<?php
    include './component/footer.php';
?>