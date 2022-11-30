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

    $sql = "UPDATE Orders SET Shipped = ?, ShippingTracking = ? WHERE OrderID = ?;";
    $stmt = $PDO->prepare($sql);
    $shipint = 0;
    if ($_POST['shipped'] == 'on')
    {
      $shipint = 1;
    }
    $stmt->execute(array($shipint, $_POST['tracking'], $_POST['orderID']));
    
    echo "<h3>Order marked as shipped</h3>";
    echo "<a class = \"nav-link\" href=\"emporders.php\"><u>Back to Orders</u></a><br>";
    
  }
  catch(PDOexception $e) 
  {
  echo "Connection to database failed: " . $e->getMessage();
  }
  ?>