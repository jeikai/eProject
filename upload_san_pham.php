<?php
    include './component/header.php';

    $img = "";
    $name_product = htmlspecialchars( $_POST['name_product'] ?? '');
    $size = htmlspecialchars( $_POST['size'] ?? '');
    $color = htmlspecialchars( $_POST['color'] ?? '');
    $type = htmlspecialchars( $_POST['type'] ?? '');
    $price = htmlspecialchars( $_POST['price'] ?? '');
    $brand = htmlspecialchars( $_POST['brand'] ?? '');
    $productID = time();
    $check = false;
    if ( isset($_POST['submit'])) {
        //Kiểm duyệt file ảnh
        $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        //Tên file
        $file_name = $_FILES['upload']['name'];
        if( !empty( $file_name )) {
            
            //Nơi nguồn
            $file_tmp_name = $_FILES['upload']['tmp_name'];
 
            //nơi đích chứa file được upload lên
            $destination = "./Ảnh_sp/${file_name}";
            $img .= $file_name;
            
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
        if ( empty($name_product) || empty($size) || empty($color) || empty($type) || empty($price)) {
            $error_message = "You must enter name, size, color, type, brand and price.";
        } else {
            if ( $connection != NULL) {
                $sql = "SELECT COUNT(*) AS count FROM products WHERE name_product='$name_product'";            
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
                    $sql = "INSERT INTO products(productID, size, color, price, name_product, type, img, brand) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";                    
                    $connection->prepare($sql)->execute([$productID, $size, $color, $price, $name_product, $type, $img, $brand]);
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
?>
<head>
    <link rel="stylesheet" href="./css/upload_san_pham.css">
</head>
<div  style="margin-left: 300px;" >
        <table style="width: 50%;height: 300px;">
            <tr>
                <td>Tên sản phẩm: </td>
                <td><input type="text" name="name_product" id="" require placeholder="Your product name"></td>      
            </tr>
            <tr>
                <td>Size: </td>
                <td><input type="number" name="size" id="" require placeholder="Your product size"></td>
            </tr>
            <tr>
                <td>Màu sắc: </td>
                <td><input type="text" name="color" id="" require placeholder="Your product color"></td>
            </tr>
            <tr>
                <td>Phân loại: </td>
                <td>
                    <input type="text" name="type" list="listdata" require placeholder="Type of your product">
		            <datalist id="listdata">
                        <option  selected>MALE</option>
                        <option >FEMALE</option>
                        <option >BABY</option>
                        <option >ADULT</option>
                        <option >TEENAGER</option>
                        <option ></option>
                        
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Thương hiệu: </td>
                <td><input type="text" name="brand" id="" placeholder="Brand name"></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm:<br>(Tối đa 5 ảnh)</td>
                <td>
                    <input type="file" name="upload" require >
                    
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
</body>
</html>

<?php
    include './component/footer.php';
?>