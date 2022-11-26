# drop all tables function, if you need to drop only one of these tables,
# traverse the tables using the following code from left to right
DROP TABLE IF EXISTS OrderItems, Orders, Product, Customer, Owner;
CREATE TABLE Owner (
    OwnerID int AUTO_INCREMENT PRIMARY KEY,
    OwnerName varchar(50) NOT NULL,
    Email varchar(50) NOT NULL,
    Phone varchar(20) NOT NULL,
    HomeAddress varchar(50) NOT NULL
);

CREATE TABLE Customer (
    CustomerID int AUTO_INCREMENT PRIMARY KEY,
    CustomerName varchar(50) NOT NULL,
    Email varchar(50) NOT NULL,
    Phone varchar(20) NOT NULL,
    HomeAddress varchar(50) NOT NULL
);

CREATE TABLE Product (
    ProductID int AUTO_INCREMENT PRIMARY KEY,
    ProductName varchar(50) NOT NULL,
    Brand varchar(50) NOT NULL,
    Num_Stock int NOT NULL,
    Price decimal(10,2) NOT NULL,
    OwnerID int NOT NULL,
    Details varchar(500) DEFAULT "No description",
    FOREIGN KEY (OwnerID) REFERENCES Owner(OwnerID)
);

CREATE TABLE Orders (
    OrderID int AUTO_INCREMENT PRIMARY KEY,
    CustomerID int NOT NULL,
    OrderDate date NOT NULL,
    Shipped boolean NOT NULL,
    ShippingAddress varchar(50) NOT NULL,
    CreditCard varchar(50) NOT NULL,
    ShippingTracking varchar(16) DEFAULT "Unassigned",
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

CREATE TABLE OrderItems (
    OrderID INT NOT NULL,
    ProductID INT NOT NULL,
    Amount INT,
    
    PRIMARY KEY (OrderID, ProductID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);


