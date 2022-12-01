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

  <div class="container-fluid bg-light text-dark text-center border-top border-bottom">
        <h3> Owner Inventory </h3>
                <?php                    
                  session_start();
                  include "credentials.php";
                  echo "<h3>Owner ID: " . $_SESSION['owner'] . "</h3>";
                  try { 
      
                    $pdo = new PDO($dsn, $username, $password);
                    
                    //Set Error Mode to Exception
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Query the database
                    $sql = "SELECT * FROM Product, Owner WHERE Product.OwnerID = Owner.OwnerID AND Owner.Email = ?;";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($_SESSION['owner']));
                    
                    echo " <h4> Owner's products </h4>";
                    echo "<table class='table table-striped table-hover'>";
                    echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Brand</th><th>Product Price</th><th>Product Quantity</th></tr>";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . $row['ProductID'] . "</td><td>" . $row['ProductName'] . "</td><td>" . $row['Brand'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['Num_Stock'] . "</td></tr>";
                    }
                    echo "</table>";
                  }
                  catch(PDOexception $e) 
                  {
                    echo "Connection to database failed: " . $e->getMessage();
                  }
                ?>
            </div>
  </div>
</body>

</html>