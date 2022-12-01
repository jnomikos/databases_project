<?php session_start(); ?>
<!doctype html>
<html lang="en">
<!-- ********************************
     * CSCI 466 Databases Fall 2022 *
     *                              *
     * Jacob Fitzenreider z085969   *
     * Matthew Keisel     z1865716  *
     * Kendrick Hardy     z1945923  *
     * Alec Tipton        z1938927  *
     * John Nomikos       z1934599  *
     *                              *
     * Group Project                *
     * Due 11/30/2022               *
     ********************************/
-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Cart - CSCIMart</title>
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

  <div class="container-fluid bg-light text-dark text-center border-top border-bottom">
    <figure class="figure">
      <img src="cart.jpg" alt="empty cart" class="figure-img img-fluid rounded">
      <figcaption class="figure-caption text-center">Your cart!
        <br>Your cart contains:</figcaption>
    </figure>
    <!-- Generate cart -->
    <div class="container-fluid bg-light text-dark text-center border-top border-bottom">
      <?php
        if(isset($_POST['remove_cart']) && isset($_POST['itemid'])) {
          $rmpid = $_POST['itemid'];
          unset($_SESSION['cart'][$rmpid]);
        }
        if(isset($_POST['modify_cart'])) {
          $mdpid = $_POST['prodid'];
          $_SESSION['cart'][$mdpid]['qty'] = $_POST['modify_cart'];
        }
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
        {                            // key    => value
          foreach($_SESSION['cart'] as $itemid => $item)
          {
            echo "<h2>" . $item['qty'] . " " . $item['name'] . "</h2>";
            $item_price = $item['qty'] * $item['price'];
            echo "<h3>$" . $item["price"] . "</h3>";
            echo "<form method=\"post\">";
            echo "<input type=\"submit\" ";
            echo "name=\"remove_cart\" value=\"Remove From Cart\"\>";
            echo "<input type=\"hidden\" name=\"itemid\" value=\"" . $itemid . "\"/>";
            echo "<br/>";
            echo "</form>";
            echo "<form method=\"post\">";
            echo "<input type=\"hidden\" name=\"prodid\" value=\"" . $itemid . "\"/>";
            echo "<select onchange=\"this.form.submit()\" name=\"modify_cart\" value=\"modify_cart\">";
            for($count = 1 ; $count <= $item['max_qty'] ; $count++) {
              echo "<option value=\"" . $count . "\"";
              if($count == $item['qty']) {
                echo " selected ";
              }
              echo ">" . $count . "</option>";
            }
            echo "</select>";
            echo "</form>";
          }
          echo "<br/>";
          echo "<a class=\"btn btn-success\" href=\"checkout.php\" role=\"button\">Check Out</a>";
          echo "<br/>";
        }
        else
        {
          echo "<p class=\"display-3\"> Cart is empty. </p>";
        }
      ?>

    </div>
  </div>
</body>

</html>