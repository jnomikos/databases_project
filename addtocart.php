<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products - CSCIMart</title>
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
            <a class="nav-link active" href="products.php">Products</a>
          </li>
          <?php
            session_start();

            if(isset($_SESSION['user']))
            {
              echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"cart.php\">Cart</a></li>";
            }
          ?>
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
  
  <?php
    if(isset($_SESSION['user']))
    {
      $pid = $_POST['productid'];
      $qty = $_POST['quantity'];
      $price = $_POST['price'];
      $name = $_POST['productname'];
      if (isset($_SESSION['cart'][$pid]))
      {
        // Adds qty to the quantity
        $_SESSION['cart'][$pid]['qty'] += $qty;
      }
      else 
      {
        // Scary 3 dimensional array
        // The third dimension is an array that contains two values
        // 'qty' and 'price'
        $_SESSION['cart'][$pid] = array("qty" => $qty, "price" => $price, "name" => $name);

      }
      echo "<p class=\"display-3 text-center\">" . $qty . " added to cart. </p>"; 
    }
    else
    {
      echo "<p class=\"display-3 text-center\">Please log in.</p>";
    }
  ?>
 
</body>
</html>
