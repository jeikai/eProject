CREATE DATABASE eProject;
USE eProject;
CREATE TABLE Users(
    userId INT  PRIMARY KEY,
    userName NVARCHAR(20),
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL, 
    address NVARCHAR(100) DEFAULT '',
    role VARCHAR(10) DEFAULT 'user'
);

CREATE TABLE Orders(
    orderId INT  PRIMARY KEY,    
    userId INT,
    orderDate DATETIME,
    description TEXT DEFAULT '',
    price_sum FLOAT 
);

CREATE TABLE OrderDetails(
    OrderDetailID INT PRIMARY KEY,
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
    categoryName NVARCHAR(100),
    gender VARCHAR(10),
    imageUrls VARCHAR(300),
    brand VARCHAR(50)
);

ALTER TABLE Orders
ADD CONSTRAINT FK_Orders_Users
FOREIGN KEY (userId) REFERENCES Users(userId); 

ALTER TABLE OrderDetails
ADD CONSTRAINT CK_OrderDetails_quantity
CHECK (quantity > 0 AND quantity <=10); 

ALTER TABLE OrderDetails
ADD CONSTRAINT FK_OrderDetail_Product
FOREIGN KEY (productId) REFERENCES Products(productId); 
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,  imageUrls, brand) VALUES (1659031232 ,5, black,5, Vali Fendi, adult, male  , black_fendi (2).jpeg, Fendi)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031263 ,4, black,7, Vali Fendi, teenager, male, black_fendi.jpeg, Fendi)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031318 ,8, black,8, Túi Fossil, adult, male, black_fossil (2).jpeg , Fossil)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031394 ,3, black,6, Fossil Vali, teenager, male, black_fossil.jpeg, Fossil)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031445 ,3, black,3, hublot Bag, children, male, black_hublot (2).jpeg , hublot)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031534 ,4, black,5, hublot Bag, adult, male, black_hublot (3).jpeg , hublot)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031627 ,2, black,3, Vali Hublot, teenager, female, black_hublot.jpeg, hublot)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031766 ,4, black,5, samsonite Bag, children, female, black_samsonite (2).jpeg, Samonite)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031802 ,2, black,6, samsonite Bag, teenager, male, black_samsonite (3).jpeg, Samonite)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659031889 ,3, black,4, samsonite Bag, adult, female, black_samsonite.jpeg, Samonite)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659055540 ,3, blue ,7, Vali Fendi, children, female, blue_fendi.jpeg , Fendi)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659055776 ,1, blue ,4, samsonite Bag, teenager, male, blue_samsonite.jpeg, Samonite)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659055876 ,3, brown,6, Brown Fendi Bag , teenager, male, brown_fendi (2).jpeg, Fendi)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659056113 ,2, brown,6, Fendi Bag , teenager, male, brown_fendi.jpeg, Fendi)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659056288 ,2, brown,4, Brown Fossil Bag, adultINSERT , female, brown_fossil.jpeg, Fossil)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659056845 ,2, brown,3, vali Victorinox , adultINSERT , male, brown_victorinox.jpeg , Victorinox)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659056928 ,3, grey ,6, Grey Victorinox Bag , adultINSERT , female, grey_victorinox.jpeg, Victorinox)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659056975 ,1, purple ,3, purple Bag, teenager, male, purple_samsonite.jpeg , Samonite)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057054 ,3, red,4, Lipault Vali , adultINSERT , male, red_lipalt.jpeg , Lipault)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057118 ,2, red,4, vali Victorinox , teenager, female, red_victorinox.jpeg, Victorinox)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057263 ,1, white,4, Victorinox Bag, adultINSERT , male, white_victorinox.jpeg , Victorinox)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057315 ,3, black,4, Vali lipalt, teenager, male, black_lipault.jpeg , Lipault)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057386 ,2, brown,5, Vali lipault , children, female, brown_lipault (2).jpeg, Lipault)
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender,imageUrls, brand) VALUES ( 1659057419 ,5, brown,4, Lipault Vali , adultINSERT I, male, brown_lipault.jpeg , Lipault)