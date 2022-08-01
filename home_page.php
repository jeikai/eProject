<?php 
	include './component/header.php';
	
	if(isset($_POST['add_to_cart'])){
		$quantity = 1;
		$productId = $_POST['productId'];
		$price = $_POST['price'];
		$orderId = time();
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
				
				$insert = "INSERT INTO  orderdetails(OrderDetailID, orderId, quantity, productId, price, userId) 
					VALUES( $orderId, $orderId, $quantity, $productId, $price, $userId);";
				$connection->prepare($insert)->execute();
				$message[] = 'product added to cart succesfully';
			}
		} catch(PDOException $e) {
			echo "Cannot execute sql: " . $e->getMessage();
		}
	}
	
?>
<!-- Notification -->
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>

<!-- Search button -->
<div class="search-container nav-link">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="text" placeholder="Search.." name="search">
	<!-- <button type="submit"><i class="fa fa-search"></i></button> -->
	</form>
</div>
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

<!-- Category -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="container-fluid padding">
	<div class="row text-center padding">
		
		<div class="col-xs-12 col-sm-6 col-md-4 " >
			
				<i class="fa fa-child"></i>	
				<h3>CHILDREN</h3>
				<p>4 - 12 years old</p>
				<input type="radio" name="category" value="children" id="">
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-4">	
			<i class="fas fa-running"></i>			
			<h3>TEENAGER</h3>
			<p>13 - 18 years old</p>
			<input type="radio" value="teenager" name="category">

		</div>
		<div class="col-sm-12 col-md-4">
			
			<i class="fas fa-hiking"></i>
			<h3>ADULT</h3>
			<p>> 18 years old</p>
			<input type="radio" value="adult" name="category">

		</div>
		
	</div>	
	
	<hr class="my-4">	
</div>
<!-- Gender -->

<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-md-4">
			
			<i class="fa fa-female"></i>	
			<h3>FEMALE</h3>
			<input type="radio" value="female" name="gender">	
		</div>
		<div class="col-md-4">
			<input type="submit" class="btn-lg" value="Find" name="" id="">
		</div>
		<div class="col-md-4">
			
			<i class="fa fa-male"></i>	
			<h3>MALE</h3>
			<input type="radio" value="male" name="gender">		
		</div>
	</div>	
	<hr class="my-4">	
</div>
</form>
<!-- brand name -->
<div class="container-fluid padding" >
	<div class="row text-center" >
		<div class="col-md-2 ">
			<a href="#Victorinox"><img src="./Ảnh_website/logo_1.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="#samsonite"><img src="./Ảnh_website/logo_2.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="#hublot"><img src="./Ảnh_website/logo_3.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="#fossil"><img src="./Ảnh_website/logo_4.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="#fendi"><img src="./Ảnh_website/logo_5.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="#lipault"><img src="./Ảnh_website/logo_6.png" alt="" style="width: 200px"></a>
		</div>
	</div>
	<hr class="my-4">
</div>

<!-- photos of products and their infor -->
<?php
	$category = $_POST['category'] ?? '';
	$gender = $_POST['gender'] ?? '';
	if ( isset( $_POST['category']) && isset( $_POST['gender'])) {
		$sql = "SELECT * FROM Products WHERE categoryName = '$category' AND gender = '$gender'; ";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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
	
	}
	else if ( isset( $_POST['category'])) {
		$sql = "SELECT * FROM Products WHERE categoryName = '$category'; ";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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
	}else if ( isset( $_POST['gender'])) {
		$sql = "SELECT * FROM Products WHERE gender = '$gender'; ";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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
	}
	else if( isset( $_POST['search'])) {
		$ket_qua = $_POST['search'] ;
		$array = explode(" ", $ket_qua);
		$name = "";
		foreach( $array as $array) {
			$name .=	"productName LIKE '%".$array."%' OR ";
		}
		$name = rtrim($name, "OR ");
		$sql = "SELECT * FROM Products WHERE $name";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		if ( count( $sp) >0) {
?>
<div class="container-fluid padding">
		<?php
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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
			}
			
	} else {
?>

<div class="container-fluid padding">
	<hr>
	<a  name="Victorinox"><h2 style="text-align: center;">Victorinox</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'Victorinox';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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


<div class="container-fluid padding">
	<hr>
	<a  name="samsonite"><h2 style="text-align: center;">Samonite</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'samonite';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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


<div class="container-fluid padding">
	<hr>
	<a  name="hublot"><h2 style="text-align: center;">Hublot</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'Hublot';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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


<div class="container-fluid padding">
	<hr>
	<a  name="fossil"><h2 style="text-align: center;">Fossil</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'Fossil';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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

<div class="container-fluid padding">
	<hr>
	<a  name="fendi"><h2 style="text-align: center;">Fendi</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'Fendi';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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

<div class="container-fluid padding">
	<hr>
	<a  name="lipault"><h2 style="text-align: center;">Lipault</h2></a>
	<?php 
		$sql = "SELECT * FROM Products WHERE brand = 'Lipault';";
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
						<p class="card-text">Phân loại: <?php echo $sp['categoryName'];?></p>
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
	}
?>
<?php
	include './component/footer.php';


?>

