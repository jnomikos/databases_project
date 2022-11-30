<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - CSCIMart</title>
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
            <a class="nav-link active" aria-current="page" href="#">Cart</a>
          </li>
          <li class="nav-item">
          <?php
            session_start();
            if(!isset($_SESSION['user']))
            {
              echo "<a class=\"nav-link\" href=\"login.php\">Login</a>";
            }
            else
            {
              echo "<a class=\"nav-link\" href=\"logout.php\">Logout</a>";
            }
          ?>          </li>
        </ul>
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
          <?php
            if(!isset($_SESSION['user']))
            {
              echo "<a class=\"nav-link\" href=\"emplogin.php\">Owner Login</a>";
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
  
  <!-- Checkout display form -->
  <?php
    if(isset($_SESSION['user']))
    {
      $qty = $_POST['quantity'];
      echo "<div class=\"text-center\">
        <img class= \"img-fluid\" src=\"cart.jpg\">
        <div class=\"container-fluid bg-light text-dark border-top border-bottom w-50\">
          <h2>Checkout</h2>
            <p>Your total is: where total $ is stored</p>
          <form action=\"submitorder.php\" method=\"post\">
            <div class=\"mb-3\">
              <label for=\"inputaddr\" class=\"form-label\">Shipping address</label>
                <input type=\"text\" class=\"form-control\" name = \"inputaddr\">
                <br>
                <label for=\"inputcc\" class=\"form-label\">Credit Card Number</label>
                <input type=\"text\" class=\"form-control\" name = \"inputcc\"><br>
                <button type=\"submit\" class=\"btn btn-success\">Check Out</button>
                </form>
                </div>
                </div>
                </body>; ";
    }
    else
    {
      echo "<p class=\"display-3 text-center\">Please log in.</p>";
    }
  ?>

</html>
