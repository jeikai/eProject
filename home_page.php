<?php 
	include './component/header.php';
	session_start();
	//$customerID = $_SESSION['customerID'];
/*
	if ( !isset($customerID) ) {
		header('Location: log_in.php');
	}
	*/
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
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-4 ">
			<a href="#" class="nav-link">
			<i class="fa fa-facebook"></i>	
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
		<div class="col-sm-12 col-md-4 col-sm-6">
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
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_1.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_2.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_3.png" alt="" style="width: 200px">
		</div>
	</div>
	<div class="row text-center">
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_4.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_5.png" alt="" style="width: 200px">
		</div>
		<div class="col-md-4 ">
			<img src="./Ảnh_website/logo_6.png" alt="" style="width: 200px">
		</div>
	</div>
	<hr class="my-4">
</div>
<!-- In ra sản phẩm -->

<div class="container-fluid padding">
	<?php 
		$sql = "SELECT * FROM Products";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		foreach ( $sp as $sp) {
	?>
			<div class="col-md-4"style="width: 33.33333%;float: left;">
				<div class="card">
					<img class="card-img-top" src="./Ảnh_sp/<?php echo $sp['imageUrls'];?>">
					<div class="card-body">
						<h4 class="card-title"><?php echo $sp['productName'];?></h4>
						<p class="card-text">Màu sắc: <?php echo $sp['color'];?></p>
						<p class="card-text">Weight: <?php echo $sp['weight'];?></p>
						<p class="card-text">Thương hiệu: <?php echo $sp['brand'];?></p>
						<p class="card-text">Giá: <?php echo $sp['price'];?></p>
						<a href="#" class="btn btn-outline-secondary">See detail</a>
					</div>
				</div>
			</div>
	<?php
		}
	?>
</div>

<?php
	include './component/footer.php';
?>
