CREATE DATABASE eProject;
USE DATABASE eProject;
CREATE TABLE User(
    userId INT AUTO_INCREMENT PRIMARY KEY,
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL, --hashed password
    address TEXT DEFAULt ''
);

CREATE TABLE Order(
    orderId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT, --FK
    orderDate DATETIME,
    description TEXT DEFAULT ''    
);
CREATE TABLE OrderDetail(
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    orderId INT, --FK
    productId INT, --FK
    price FLOAT, --promotion
    quantity INT --constraint check: 1->10
);

CREATE TABLE Product (
    productId INT PRIMARY KEY,
    weight float NOT NULL,    
    color varchar(20) NOT NULL,
    price float NOT NULL,
    productName VARCHAR(150) NOT NULL,
    categoryId INT--FK
);
CREATE TABLE Category (
    categoryId INT PRIMARY KEY,
    categoryName VARCHAR(150) NOT NULL
);
