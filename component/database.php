<?php
    define('SERVER', 'localhost');
    define('DB_NAME', 'eProject');
    define('DB_USER_NAME', 'root');
    define('DB_PASSWORD', '');
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS ".DB_NAME; 
    $sql_create_table_customer = "
        CREATE TABLE IF NOT EXISTS customer (
            customerID int NOT NULL,
            name nvarchar(30),
            phone varchar(10),
            address nvarchar(50)
        );
    ";
    $sql_create_table_orders = "
        CREATE TABLE IF NOT EXISTS orders (
            orderID int NOT NULL,
            customerID int,
            oderDate date,
            price float
        );
    ";
    $sql_create_table_details = "
        CREATE TABLE IF NOT EXISTS details (
            detailID int NOT NULL,
            orderID int,
            quantity int,
            productID int
        );
    ";
    $sql_create_table_products = "
        CREATE TABLE IF NOT EXISTS products (
            productID int NOT NULL,
            size float,
            color nvarchar(20),
            price float,
            name_product nvarchar(50),
            type nvarchar(50),
            img nvarchar(100),
            brand nvarchar(20)
        );
    "; 
    $sql_create_table_account = "
        CREATE TABLE IF NOT EXISTS account (
            phone varchar(10) NOT NULL,
            user_name varchar(100),
            password char(40),
            customerID int
        ); 
    ";
    //pdo = PHP Data Object
    $connection_string = "mysql:host=".SERVER;
    $connection = null;    
    try {
        $connection = new PDO($connection_string, 
                DB_USER_NAME, DB_PASSWORD);   
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        if($connection->query($sql_create_db) == TRUE) {
            //echo "Create DB successfully<br>";
            
            $connection->query("USE ".DB_NAME);
           
                $connection->exec($sql_create_table_customer);
                //echo "Table customer created successfully<br>";

                $connection->exec($sql_create_table_orders);
                //echo "Table orders created successfully<br>";

                $connection->exec($sql_create_table_details);
                //echo "Table detail created successfully<br>";

                $connection->exec($sql_create_table_products);
                //echo "Table products created successfully<br>";
                
                $connection->exec($sql_create_table_account);
                // echo "Table account created";
        } else {
            echo "Create DB failed<br>";
        }
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }    
?>