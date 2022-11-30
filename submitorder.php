<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Submitted</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>
  <?php
    include "credentials.php";
    session_start();
    
    $date = date('Y-m-d H:i:s');
    $shipped = 0;
    $shippingaddr = $_POST['inputaddr'];
    $cc = $_POST['inputcc'];
    $tracking = "unassigned";
    $total = 0;
    $custID = null;
    $orderID = null;
    try 
    { 
      $pdo = new PDO($dsn, $username, $password);
      
      //Set Error Mode to Exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT CustomerID FROM Customer WHERE Email = ?;";
      $rs = $pdo->prepare($sql);
      $rs->execute(array($_SESSION['user']));
      $id = $rs->fetchAll(PDO::FETCH_ASSOC);
      $custID = $id[0]['CustomerID'];
            
      $sql = "INSERT INTO Orders (CustomerID, OrderDate, Shipped, ShippingAddress, CreditCard, ShippingTracking)
              VALUE (?, ?, ?, ?, ?, ?);";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array($custID, $date, $shipped, $shippingaddr, $cc, $tracking));
      
      $sql = "SELECT OrderID FROM Orders WHERE CustomerID = ? AND OrderDate = ?";
      $rs = $pdo->prepare($sql);
      $rs->execute(array($custID, $date));
      $oid = $rs->fetchAll(PDO::FETCH_ASSOC);
            
      $orderID = $oid[0]['OrderID'];
      
      foreach($_SESSION['cart'] as $itemid => $item)
      {
        $total += $item['qty'] * $item['price'];
        $sql = "INSERT INTO OrderItems (OrderID, ProductID, Amount)
                VALUES (?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($orderID, $itemid, $item['qty']));
        
        $sql = "UPDATE Product SET Num_Stock = Num_Stock - ? WHERE ProductID = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($item['qty'], $itemid));
      }

    }
    catch(PDOexception $e) 
    {
      echo "Connection to database failed: " . $e->getMessage();
    }
  ?>

</body>
</html>
