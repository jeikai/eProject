create database eProject;
use eProject;
CREATE TABLE IF NOT EXISTS customer (
	customerID int NOT NULL,
	name nvarchar(30),
	phone varchar(10),
	address nvarchar(50),
	city nvarchar(20)
);
CREATE TABLE IF NOT EXISTS orders (
	orderID int NOT NULL,
	customerID int,
	oderDate date,
	price float
);
CREATE TABLE IF NOT EXISTS detail (
	detailID int NOT NULL,
	orderID int,
	quantity int,
	productID int,
);
CREATE TABLE IF NOT EXISTS products (
	productID int NOT NULL,
	size float,
	color nvarchar(20),
	price float,
	name_product nvarchar(50)
);
CREATE TABLE IF NOT EXISTS account (
	phone varchar(10) NOT NULL,
	user_name varchar(100),
	password char(40)
); 
alter table orders add constraint pk_id_order primary key(orderID);

alter table customer add constraint pk_id_customer primary key(customerID);

alter table details add constraint pk_id_detail primary key(detailID);

alter table products add constraint pk_id_product primary key(productID);

