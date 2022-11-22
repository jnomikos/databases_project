INSERT INTO Owner (OwnerName, Email, Phone, HomeAddress) VALUES 
('John', 'john@gmail.com', '1234567890', '123 Main St'),
('Jane', 'jane@gmail.com', '0987654321', '456 Main St'),
('Jack', 'jack@gmail.com', '6252521523', '789 Main St'),
('Jill', 'jill@gmail.com', '5124125125', '159 Main St');

INSERT INTO Customer (CustomerName, Email, Phone, HomeAddress) VALUES
('Bob', 'bob@gmail.com', '1231234123', '125 Main St'),
('Bill', 'bill@gmail.com', '4564564563', '126 Main St'),
('Ben', 'ben@gmail.com', '7897897893', '127 Main St'),
('Smith', 'smith@gmail.com', '1472583690', '128 Main St'),
('Sally', 'sally@gmail.com', '9876543210', '129 Main St');

INSERT INTO Product (ProductName, Brand, Num_stock, Price, OwnerID) VALUES 
('Shoes', 'Nike', 10, 50.00, 1),
('Shoes', 'Puma', 10, 50.00, 2),
('Shoes', 'Under Armour', 10, 50.00, 3),
('Shoes', 'Adidas', 10, 50.00, 4),
('Shirt', 'Nike', 10, 25.00, 1),
('Shirt', 'Puma', 10, 25.00, 2),
('Shirt', 'Under Armour', 10, 25.00, 3),
('Shirt', 'Adidas', 10, 25.00, 4),
('Pants', 'Nike', 10, 30.00, 1),
('Pants', 'Puma', 10, 30.00, 2),
('Pants', 'Under Armour', 10, 30.00, 3),
('Pants', 'Adidas', 10, 30.00, 4),
('Socks', 'Nike', 10, 10.00, 1),
('Socks', 'Puma', 10, 10.00, 2),
('Socks', 'Under Armour', 10, 10.00, 3),
('Socks', 'Adidas', 10, 10.00, 4),
('Hats', 'Nike', 10, 15.00, 1),
('Hats', 'Puma', 10, 15.00, 2),
('Hats', 'Under Armour', 10, 15.00, 3),
('Hats', 'Adidas', 10, 15.00, 4);


INSERT INTO Orders(CustomerID, OrderDate, Shipped, ShippingAddress, CreditCard) VALUES 
(1,'2022-10-15', 1, '125 Main St', '1234123412341234'),
(2,'2022-10-21', 0, '126 Main St', '4567456745674567'),
(3,'2022-10-25', 1, '21 Main St', '7896789678967896'),
(4,'2022-11-11', 0, '8000 Main St', '9876547321012364'),
(5,'2022-11-21', 1, '3 Main St', '3836557625042364');


INSERT INTO OrderItems(OrderID, ProductID, Amount) VALUES
(1, 1, 2),
(1, 10, 1),
(2, 6, 8),
(3, 18, 1),
(4, 18, 1),
(5, 2, 3),
(5, 1, 1);