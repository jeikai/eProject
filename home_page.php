<?php 
	include './component/header.php';
	session_start();
	$userId = $_SESSION['userId'];
	
	if ( !isset($userId) ) {
		header('Location: log_in.php');
	}
	
	if(isset($_POST['add_to_cart'])){
		$quantity = 1;
		$productId = $_POST['productId'];
		$price = $_POST['price'];
		$orderId = time();
		$date = date("d/m/Y");
		try {
			$sql = "SELECT * FROM orderdetails WHERE productId = '$productId';";
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $connection->prepare($sql);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_ASSOC); 
			$result = $statement->fetchAll();
			
			//Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
			if( count($result) > 0) {
				$message[] = 'product already added to cart';
			} else {
				
				$insert = "INSERT INTO  orderdetails(OrderDetailID, orderId, quantity, productId, price) 
					VALUES( $orderId, $orderId, $quantity, $productId, $price); ';
				INSERT INTO orders(orderId, userId) VALUES($orderId, $userId);";
				$connection->prepare($insert)->execute();
				$message[] = 'product added to cart succesfully';
			}
		} catch(PDOException $e) {
			echo "Cannot execute sql: " . $e->getMessage();
		}
	}
?>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>
<!-- Slide show -->
<div id="slides" class="carousel slide" data-ride="carousel">
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
		<li data-target="#slides" data-slide-to="2"></li>		
		<li data-target="#slides" data-slide-to="3"></li>
		<li data-target="#slides" data-slide-to="4"></li>
	</ul>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="./Ảnh_website/anh1.png">
		</div>
		<div class="carousel-item ">
			<img src="./Ảnh_website/anh2.png">
		</div>
		<div class="carousel-item ">
			<img src="./Ảnh_website/anh3.png">
		</div>
		<div class="carousel-item ">
			<img src="./Ảnh_website/anh4.png">
		</div>
		<div class="carousel-item ">
			<img src="./Ảnh_website/anh5.png">
		</div>
	</div>
</div>

<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Welcome to Brox Luggage</h1>
		</div>
		<!-- Horizontal Rule -->
		<hr> 
		<div class="col-12">
			<p>Standing by you everywhere in the world</p>
		</div>
	</div>
</div>

<div class="container-fluid padding">
	<div class="row text-center padding">
		
		<div class="col-xs-12 col-sm-6 col-md-4 " >
			<a href="#" class="nav-link">
			<i class="fa fa-female"></i>	
			<h3>FEMALE</h3>
			<p>FOR WOMEN</p>
			</a>					
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-4">
			<a href="#" class="nav-link">
			<i class="fa fa-male"></i>			
			<h3>FEMALE</h3>
			<p>FOR MEN</p>
			</a>
		</div>
		<div class="col-sm-12 col-md-4">
			<a href="#" class="nav-link">
			<i class="fas fa-baby"></i>
			<h3>CHILDREN</h3>
			<p>FOR CHILDREN UNDER 18 YEARS OLD</p>
			</a>
		</div>
		
	</div>	
	
	<hr class="my-4">	
</div>

<div class="container-fluid padding" >
	<div class="row text-center" >
		<div class="col-md-2 ">
			<a href="#gucci"><img src="./Ảnh_website/logo_1.png" alt="" style="width: 200px"></a>
			
		</div>
		<div class="col-md-2 ">
			<img src="./Ảnh_website/logo_2.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-2 ">
			<img src="./Ảnh_website/logo_3.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-2 ">
			<img src="./Ảnh_website/logo_4.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-2 ">
			<img src="./Ảnh_website/logo_5.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-2 ">
			<img src="./Ảnh_website/logo_6.png" alt="" style="width: 200px">
		</div>
	</div>
	<hr class="my-4">
</div>
<!-- In ra sản phẩm -->

<div class="container-fluid padding">
	<?php 
		$sql = "SELECT * FROM Products;";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		
		foreach ( $sp as $sp) {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="col-md-4"style="width: 33.33333%;float: left;">
				<div class="card">
					<img class="card-img-top" src="./Ảnh_sp/<?php echo $sp['imageUrls'];?>">
					<div class="card-body">
						<h4 class="card-title" ><?php echo $sp['productName'];?></h4>
						<input type="hidden" class="card-text" name="productId" value="<?php echo $sp['productId'];?> ">
						<p class="card-text" >Màu sắc: <?php echo $sp['color'];?></p>
						<p class="card-text" >Weight: <?php echo $sp['weight'];?></p>
						<p class="card-text">Giới tính: <?php echo $sp['gender']?></p>
						<p class="card-text" >Thương hiệu: <?php echo $sp['brand'];?></p>
						<input type="hidden" class="card-text" name="price" value="<?php echo $sp['price'];?> ">
						<p class="card-text">Giá: <?php echo $sp['price'];?>$</p>
						<input type="submit" class="btn btn-outline-secondary" value="add to cart" name="add_to_cart">
					</div>
				</div>
			</div>
	</form>		
	<?php
		}
	?>
</div>

<?php
	include './component/footer.php';


?>

