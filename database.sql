CREATE DATABASE eProject;
USE eProject;
CREATE TABLE Users(
    userId INT AUTO_INCREMENT PRIMARY KEY,
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL, 
    address TEXT DEFAULT '',
    role VARCHAR(10) DEFAULT 'user'
);

CREATE TABLE Orders(
    orderId INT AUTO_INCREMENT PRIMARY KEY,    
    userId INT NOT NULL,
    orderDate DATETIME,
    description TEXT DEFAULT ''    
);

ALTER TABLE Orders
ADD CONSTRAINT FK_Orders_Users
FOREIGN KEY (userId) REFERENCES Users(userId); 

CREATE TABLE OrderDetails(
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    orderId INT, --FK
    productId INT, --FK
    price FLOAT, --promotion
    quantity INT --constraint check: 1->10
);

ALTER TABLE OrderDetails
ADD CONSTRAINT CK_OrderDetails_quantity
CHECK (quantity > 0 AND quantity <=10); 


ALTER TABLE OrderDetails
ADD CONSTRAINT FK_OrderDetail_Order
FOREIGN KEY (userId) REFERENCES Users(userId); 

CREATE TABLE Products(
    productId INT PRIMARY KEY,
    weight float NOT NULL,    
    color varchar(20) NOT NULL,
    price float NOT NULL,
    productName VARCHAR(150) NOT NULL,
    categoryId INT--FK,
    imageUrls VARCHAR(300),
    brand VARCHAR(50)
);

ALTER TABLE OrderDetails
ADD CONSTRAINT FK_OrderDetails_Products
FOREIGN KEY (productId) REFERENCES Products(productId); 

CREATE TABLE Categories (
    categoryId INT PRIMARY KEY,
    categoryName VARCHAR(150) NOT NULL
);

ALTER TABLE Product
ADD CONSTRAINT FK_Products_Categories
FOREIGN KEY (categoryId) REFERENCES Products(categoryId); 


INSERT INTO Categories(categoryId, categoryName) VALUES
(1, 'Electronics'),
(2, 'Sea foods'),
(3, 'Fruits');

INSERT INTO Products(productName, color, price,categoryId, imageUrls,brand) VALUES
('Túi Gucci', 'red', 11.22, 1, '293608736_746568929995037_2608847355166619797_n.jpg;product-1.jpg', 'Gucci')
