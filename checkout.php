<?php
    include './component/header.php';
    
?>
<div class="container">
<head>
    <link rel="stylesheet" href="./css/checkout.css">
</head>
<section class="checkout-form">
    <h1 class="heading">complete your order</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="display-order">
        <?php
            $sql = "SELECT * FROM Users a JOIN orderdetails b
                ON a.userId = b.userId JOIN Products c 
                ON b.productId = c.productId WHERE a.userId = $userId";
            $statement = $connection->prepare($sql);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_ASSOC); 
			$sp = $statement->fetchAll();

            $total = 0;
            $grand_total = 0;
            $sale = '';
            if ( count($sp) > 0) {
                foreach( $sp as $sp ) {
                    $total_price = number_format( $sp['price'] * $sp['quantity']);
                    $grand_total = $total += $total_price;

        ?>
        <span><?= $sp['productName']; ?>(<?= $sp['quantity']?>)</span>
        <?php
                }
            }
            if ( ($time >= '00:00' && $time <= '00:15') 
            || ($time >= '09:00' && $time <= '09:15') 
            || ($time >= '12:00' && $time <= '12:15') 
            || ($time >= '18:00' && $time <= '18:15') 
            || ($time >= '21:00' && $time <= '21:15')) {
                $grand_total -= $grand_total * (30/100);
                $sale = "Sale up to 30% in golden hour frame";
            } 
        ?>
        <span class="grand-total"> grand total : $<?= $grand_total; ?>/- <?php echo $sale;?></span>
    </div>

    <div class="flex">
        <?php
            $select = "SELECT * FROM Users WHERE userId = $userId";
            $statement = $connection->prepare($select);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_ASSOC); 
			$user = $statement->fetchAll();
            foreach ( $user as $user) {
        ?>
        <div class="inputBox">
            <span>Your Name</span>
            <input type="text" name="userName" value="<?php echo $user['userName'];?>" id="">
        </div>
        <div class="inputBox">
            <span>Your Phone-number</span>
            <input type="text" name="phoneNumber" readonly value="<?php echo $user['phoneNumber'];?>" id="">
        </div>
        <div class="inputBox">
            <span>Your Address</span>
            <input type="text" name="address" value="<?php echo $user['address'];?>" id="">
        </div>
        <div class="inputBox">
            <span>Your description</span>
            <input type="text" name="description">
        </div>
        <?php
            }
        ?>
    </div>
    <input type="submit" name="order" class="btn" id="">
    </form>
</section>
</div>
<?php
    
    if ( isset( $_POST['order'])) {
        $userName = $_POST['userName'] ?? '';
        $address = $_POST['address'] ?? '';
        $phoneNumber = $_POST['phoneNumber'] ?? '';
        $update = "UPDATE Users SET userName = '$userName', address = '$address' 
        WHERE userId = $userId;";
        $statement = $connection->prepare($update);
        $statement->execute();
        
        $orderId = time();
        $orderDate = date("d/m/Y");
        $price_sum = $grand_total;
        $description = $_POST['description'] ?? '';
        $insert = "INSERT INTO Orders(orderId, userId, orderDate, description, price_sum)
        VALUES( '$orderId', '$userId', '$orderDate', '$description', '$price_sum');";
        $statement = $connection->prepare($insert);
        $statement->execute();

        echo "
            <div class='order-message-container'>
            <div class='message-container'>
            <h3>thank you for shopping!</h3>
            <div class='order-detail'>
                <span class='total'> total : $".$grand_total."/-  </span>
            </div>
            <div class='customer-details'>
                <p> your name : <span>".$userName."</span> </p>
                <p> your number : <span>".$phoneNumber."</span> </p>
                <p> your address : <span>".$address."</span> </p>
            </div>
                <a href='./home_page.php' class='btn'>continue shopping</a>
            </div>
            </div>
        ";
    }
    include './component/footer.php';
?>