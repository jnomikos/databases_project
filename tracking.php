<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="logoipsum.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
	          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
          <?php
            session_start();

            if(isset($_SESSION['user']))
            {
              echo "<a class=\"nav-link\" href=\"cart.php\">Cart</a>";
            }
          ?>        
          </li>
          <li class="nav-item">
          <?php
            if(!isset($_SESSION['user']))
            {
              echo "<a class=\"nav-link\" href=\"login.php\">Login</a>";
            }
            else
            {
              echo "<a class=\"nav-link\" href=\"logout.php\">Logout</a>";
            }
          ?>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
          <?php
            if(!isset($_SESSION['user']))
            {
              if(!isset($_SESSION['owner']))
              {
              echo "<a class=\"nav-link\" href=\"emplogin.php\">Owner Login</a>";
              }
              else 
              {
              echo "<a class=\"nav-link\" href=\"dashboard.php\">Owner Dashboard</a>";
              }
            }
            else
            {
              echo "<a class=\"nav-link\" href=\"tracking.php\">Order Tracking</a>"; 
            }
          ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Here's where the orders and related info go -->
  <!-- Need to query the DB based on user email and list all orders with their status -->
  <div class="container-fluid w-50">
<?php
            include('credentials.php');

    $PDO = new PDO($dsn, $username, $password);

    //Set Error Mode to Exception
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //get order id info
    echo "<h3>Order Information:</h3>";

    if(isset($_SESSION['user'])){
            $Email=$_SESSION['user'];
            $rs = $PDO->prepare("SELECT Orders.OrderID, OrderDate, Shipped, ShippingAddress, ShippingTracking, sum(Amount * Price) AS OrderTotal 
            FROM Customer, Product, Orders, OrderItems 
            WHERE OrderItems.OrderId = Orders.OrderID AND Product.ProductID = OrderItems.ProductID AND Orders.CustomerID = Customer.CustomerID AND Customer.Email = ?
            GROUP BY OrderItems.OrderId;");
            $rs->execute(array($Email));
            $rows = $rs->fetchALL(PDO::FETCH_ASSOC);

            echo "<table border=2 cellspacing=1 cellpadding= 5>";
            echo "<tr>";
            foreach($rows[0] as $key => $item){
                    echo "<th>$key</th>";
            }
            echo "</tr>";
            foreach($rows as $row){
                    echo "<tr>";
                    foreach($row as $key => $item){
                            echo "<td>$item</td>";
                    }
                    echo "</tr>";
            }
            echo "</table>";
            echo "<br/>";

            $rs = $PDO->prepare("SELECT sum(a.OrderTotal) AS Total_Of_All_Orders FROM (SELECT Orders.OrderID, OrderDate, Shipped, ShippingAddress, ShippingTracking, sum(Amount * Price) AS OrderTotal FROM Customer, Product, Orders, OrderItems where OrderItems.OrderId = Orders.OrderID and Product.ProductID = OrderItems.ProductID and Orders.CustomerID = Customer.CustomerID and Customer.Email = '$Email') AS a");
            $rs->execute();
            $rows = $rs->fetchALL(PDO::FETCH_ASSOC);

            echo "<table border=2 cellspacing=1 cellpadding=5>";
            echo "<tr>";
            foreach($rows[0] as $key => $item){
                    echo "<th>$key</th>";
            }
            echo "</tr>";
            foreach($rows as $row){
                    echo "<tr>";
                    foreach($row as $key => $item){
                            echo "<td>$item</td>";
                    }
                    echo "</tr>";
            }
            echo "</table>";
    }
?>