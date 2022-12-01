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
  <title>Product Name - CSCIMart</title>
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
            <a class="nav-link active" aria-current="page" href="products.php">Products</a>
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
          ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  include "credentials.php";

  try 
  { 
    $pdo = new PDO($dsn, $username, $password);
    //Set Error Mode to Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Query and fetch data
    $rs = $pdo->prepare("SELECT * FROM Product WHERE ProductID = ?");
    $rs->execute(array($_GET["productid"]));
    $productinfo = $rs->fetch(PDO::FETCH_ASSOC);
      
    echo "<div class=\"container-fluid bg-light text-dark text-center border-top border-bottom\">";
    echo "<div class=\"row\">";
      echo "<div class=\"col\">";
        echo "<img src=\"productimg\product" . $productinfo['ProductID'] . ".jpg\" class=\"img-fluid\">";
      echo "</div>";
      echo "<div class=\"col\">";
        echo "<p class=\"display-3 text-center\">" . $productinfo['ProductName'] . " by " . $productinfo['Brand'];
        echo "</p>";
        echo "<p class=\"lead text-center\"> product Information goes in here </p>";
        echo "<p class=\"display-3 text-center\">\$" . $productinfo['Price'];
        echo "<p class=\"display-6 text-center\">" . $productinfo['Num_Stock'] . " left in stock. Order now!";
      echo "</div>"; 
    echo "</div>";

    if(isset($_SESSION['user']))
    {
      $pid = $productinfo['ProductID'];
      if (isset($_SESSION['cart'][$pid]) && !empty($_SESSION['cart']))
      {
        $maximum_allowed = $productinfo['Num_Stock'] - $_SESSION['cart'][$pid]['qty'];
      } else {
        $maximum_allowed = $productinfo['Num_Stock'];
      }
      
      echo "<form action=\"addtocart.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"" . $productinfo['ProductID'] . "\"/>";
        echo "<input type=\"hidden\" name=\"price\" value=\"" . $productinfo['Price'] . "\"/>";
        echo "<input type=\"hidden\" name=\"max_qty\" value=\"" . $productinfo['Num_Stock'] . "\"/>";
        echo "<input type=\"hidden\" name=\"productname\" value=\"" . $productinfo['ProductName'] . "\"/>";
        echo "<label for=\"quantity\">Quantity:</label>";
        echo "<input type=\"number\" name=\"quantity\" id=\"quantity\" value =\"0\" min=\"0\" max=\"" . $maximum_allowed . "\"/>";
        echo "<br>";
    
      //Submit Button
        echo "<input type=\"submit\" value=\"Add To Cart\"/>";
      echo "</form>";
    }
  }

  catch(PDOexception $e) 
  {
    echo "Connection to database failed: " . $e->getMessage();
  }
  ?>
  </div>
</body>

</html>