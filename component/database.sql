create database eProject;
use eProject;
        CREATE TABLE customer (
                customerID int PRIMARY KEY,
                user_name nvarchar(30) NOT NULL,
                phone varchar(10) NOT NULL,
                address nvarchar(50) NOT NULL,
                password char(40) NOT NULL           
        );
        CREATE TABLE orders (
            orderID int PRIMARY KEY,
            customerID int NOT NULL,
            orderDate date NOT NULL,
            price float NOT NULL,
            quantity int NOT NULL,
            productID int NOT NULL,
            name_product nvarchar(50) NOT NULL
        );

        CREATE TABLE products (
            productID int PRIMARY KEY,
            size float NOT NULL,    
            color nvarchar(20) NOT NULL,
            price float NOT NULL,
            name_product nvarchar(50) NOT NULL,
            type nvarchar(50) NOT NULL,
            img nvarchar(100) NOT NULL,
            brand nvarchar(20) NOT NULL
        );
alter table orders add constraint pk_id_order primary key(orderID);

alter table customer add constraint pk_id_customer primary key(customerID);

alter table products add constraint pk_id_product primary key(productID);

