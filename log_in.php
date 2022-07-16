<?php
	include './component/database.php';
	$error = "";
	if ( isset( $_POST['sign_in']) ) {
		header('Location: ./home_page.php');
		$user_name = htmlspecialchars($_POST['email'] ?? ''); 
        $password = htmlspecialchars($_POST['password'] ?? '');  
		
		if(empty($user_name) || empty($password)) {
            $error = "You must enter username or password";            
        } else {

            $sql = "SELECT * FROM account WHERE user_name='$user_name'; ";            
            if ( $connection != NULL) {
            try {
                
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql); 
                $statement->execute();
				//Chế độ lấy dữ liệu ra
                $statement->setFetchMode(PDO::FETCH_ASSOC); 
                $result = $statement->fetchAll();                

                if(count($result) > 0) {
                    //find user with user name, compare password
                    $password_hash = $result[0]['password'];
                    
                    if($password_hash == sha1($password)) {
                        
                    } else {
                        $error = "Wrong username or password";
                    }
                    
                } else {
                    $error = "Wrong username or password";
                }                
            } catch(PDOException $e) {
                $error = "Cannot execute sql: " . $e->getMessage();
            }
            }
        }
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
	
	<link rel="stylesheet" href="./css/log_in.css">
</head>
<body style="background:#cbced3; " >
	<div class="divtitle">
	<div class="title">BROX LUGGAGE</div>
	<div class="subtitle"><caption>Start your journey</caption></div>
	</div>
	<form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
	<div class="login">
		<div class="type">
			<input type="email" placeholder="Email address or phone number" class="textbox" required name="email">
		</div>
		<div class="type">
			<input type="password" placeholder="Password" class="textbox" required name="password">
		</div>
		<div>
			<p style="color: red;text-align: right;"><?php echo $error; ?></p>
		</div>
		<div class="type">
			<input type="submit" value="Log In" class="logIn" name="sign_in">
		</div>
		<div class="type">
			<a href="" class="forget_pass">Forgotten password?</a>
		</div>
		<div class="type">
			<hr style="width: 300px;color: #e4e6e9;margin-left: 0px;">
		</div>
		<div class="type">
			<input type="submit" value="Create a new account" class="new_account" >
		</div>
	</div>
	</form>
</body>
</html>