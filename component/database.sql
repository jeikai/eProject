CREATE DATABASE eProject;
USE eProject;
CREATE TABLE Users(
    userId INT AUTO_INCREMENT PRIMARY KEY,
    userName NVARCHAR(20),
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL, 
    address NVARCHAR(100) DEFAULT '',
    role VARCHAR(10) DEFAULT 'user'
);

CREATE TABLE Orders(
    orderId INT AUTO_INCREMENT PRIMARY KEY,    
    userId INT,
    orderDate DATETIME,
    description TEXT DEFAULT ''    
);



CREATE TABLE OrderDetails(
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    orderId INT, 
    productId INT,
    price FLOAT,
    quantity INT
);

CREATE TABLE Products(
    productId INT PRIMARY KEY,
    weight float NOT NULL,    
    color varchar(20) NOT NULL,
    price float NOT NULL,
    productName VARCHAR(150) NOT NULL,
    categoryId INT,
    imageUrls VARCHAR(300),
    brand VARCHAR(50)
);

CREATE TABLE Categories (
    categoryId INT PRIMARY KEY,
    categoryName VARCHAR(150) NOT NULL
);

ALTER TABLE Products
ADD CONSTRAINT FK_Products_Categories
FOREIGN KEY (categoryId) REFERENCES Categories(categoryId); 

ALTER TABLE Orders
ADD CONSTRAINT FK_Orders_Users
FOREIGN KEY (userId) REFERENCES Users(userId); 

ALTER TABLE OrderDetails
ADD CONSTRAINT CK_OrderDetails_quantity
CHECK (quantity > 0 AND quantity <=10); 

ALTER TABLE OrderDetails
ADD CONSTRAINT FK_OrderDetail_Product
FOREIGN KEY (productId) REFERENCES Products(productId); 