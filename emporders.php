<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <img src="logoipsum.png">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
	          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
      </div>
    </div>
  </nav>

<?php
include "credentials.php";
session_start();

try
{

    $PDO = new PDO($dsn, $username, $password);

    //Set Error Mode to Exception
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "<h2>Employee Dashboard</h2>";

    //An order fulfillment page that allows store employees to see details on individual orders, and mark them as shipped, add notes, contact the user, etc.
    echo "<h3>Order Fulfillment</h3>";

    $sql = "SELECT * FROM Orders, Customer where Orders.CustomerID = Customer.CustomerID AND Orders.Shipped = 0;";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();                 //table that shows all orders to be shipped
    echo "<h3> Orders to be Shipped </h3>";            
    echo "<table class='table table-striped table-hover'>";
    echo "<tr><th>Order ID</th><th>Order Date</th><th>Shipped?</th><th>Shipping Address</th><th>Tracking Number</th><th>Customer Name</th><th>Customer Email</th><th>Customer Address</th><th>Customer Phone</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>" . $row['OrderID'] . "</td><td>" . $row['OrderDate'] . "</td><td>" . $row['Shipped'] . "</td><td>" . $row['ShippingAddress'] . "</td><td>" . $row['ShippingTracking'] . "</td><td>" . $row['CustomerName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['HomeAddress'] . "</td><td>" . $row['Phone'] . "</td></tr>";
    }
    echo "</table>"; 

    echo "<form action='setordershipped.php' method='post'>";          //form to mark order as shipped and add notes
    echo "<label for='orderID'>Order ID: </label>";
    echo "<input type='text' name='orderID' id='orderID'>";
    echo "<label for='shipped'>Shipped: </label>";
    echo "<input type='checkbox' name='shipped' id='shipped'>";
    echo "<label for='tracking'>Tracking: </label>";
    echo "<input type='text' name='tracking' id='tracking'>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";

    $sql = "SELECT * FROM Orders, Customer where Orders.CustomerID = Customer.CustomerID;";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();                 //table that shows all orders
    echo "<h3> All Orders </h3>";            
    echo "<table class='table table-striped table-hover'>";
    echo "<tr><th>Order ID</th><th>Order Date</th><th>Shipped?</th><th>Shipping Address</th><th>Tracking Number</th><th>Customer Name</th><th>Customer Email</th><th>Customer Address</th><th>Customer Phone</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>" . $row['OrderID'] . "</td><td>" . $row['OrderDate'] . "</td><td>" . $row['Shipped'] . "</td><td>" . $row['ShippingAddress'] . "</td><td>" . $row['ShippingTracking'] . "</td><td>" . $row['CustomerName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['HomeAddress'] . "</td><td>" . $row['Phone'] . "</td></tr>";
    }
    echo "</table>";   
    
    $sql = "SELECT * FROM Orders;";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    echo "<h3>Contact Customer</h3>";          //form to contact customer
    echo "<form action='emporders.php' method='post'>";
    echo "<select name='OrderID'>";
    echo "<option value=''>Select an Order</option>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='" . $row['OrderID'] . "'>" . $row['OrderID'] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' name='contact' value='Contact Customer'>";
    echo "</form>";
}
catch(PDOexception $e) 
{
echo "Connection to database failed: " . $e->getMessage();
}
?>