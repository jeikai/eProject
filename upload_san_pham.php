<?php
    include './component/header.php';
    $img = "";
    if ( isset($_POST['submit'])) {
        //Kiểm duyệt file ảnh
        $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        //Tên file
        $file_name = $_FILES['upload']['name'];
        if( !empty( $file_name )) {
            //dung lượng kích cỡ của file
            $file_size = $_FILES['upload']['size'];
            //Nơi nguồn
            $file_tmp_name = $_FILES['upload']['tmp_name'];
            
            //Vì lo sợ nhiều người khác nhau upload file tên trùng nhau
            //Dẫn đến file bị ghi đè, nên ta phải có cách khác để xử lí
            $generated_file = time().'-'.$file_name;
            
            //nơi đích chứa file được upload lên
            $destination = "./Ảnh_sp/${generated_file}";
            $img = $generated_file.", ".'<br>';
            //Lấy ra đuôi file bằng hàm explode
            //Khi gặp dấu chấm, hàm sẽ tách chuỗi đó ra
            //end: lấy phần tử cuối trong mảng
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));

            //Kiểm tra tên file
            if ( in_array($file_extension, $permitted_extensions)) {
                if( $file_size > 1000000) {
                    //Upload file từ nơi nguồn lên đích là destination
                    //move_uploaded_file($file_tmp_name, $destination);
                } else {
                    $error_message = 'File is too big';
                }
            } else {
                $error_message = 'Invalid file type';
            }
        } else {
            $error_message = 'No such file selected';
        }
    }
?>
<div  style="margin-left: 300px;">
        <table >
            <tr>
                <td>Tên sản phẩm: </td>
                <td><input type="text" name="ten_sp" id="" require></td>      
            </tr>
            <tr>
                <td>Size: </td>
                <td><input type="number" name="size" id="" require></td>
            </tr>
            <tr>
                <td>Màu sắc: </td>
                <td><input type="text" name="color" id="" require></td>
            </tr>
            <tr>
                <td>Phân loại: </td>
                <td>
                    <input type="text" name="type" list="listdata" require>
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
                <td>Ảnh sản phẩm:<br>(Tối đa 5 ảnh)</td>
                <td>
                    <input type="file" name="upload" require>
                    <p><?php echo $img;?></p>
                </td>

            </tr>
            <tr>
                <td>Giá bán: </td>
                <td><input type="number" name="price" id="" require></td>
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