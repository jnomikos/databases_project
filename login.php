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
  <title>Customer Login - CSCIMart</title>
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
            <a class="nav-link active" aria-current="page" href="#">Login</a>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
          <?php
            session_start();
            
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

  <!-- Login info form -->
  <div class="container-fluid w-50">
    <form action="userauth.php" method="post">
      <div class="mb-3 col offset-md-1">
        <label for="inputemail" class="form-label">Email address</label>
        <input type="email" class="form-control" name="inputemail">
        <label for="inputowner" class="form-label">Shop To Login To</label>
        <select name="inputowner" class="form-control" name="inputowner">
        <?php
          include "credentials.php";
          session_start();
          
          $pdo = new PDO($dsn, $username, $password);
          
          //Set Error Mode to Exception
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          //Query the database
          $sql = "SELECT * FROM Owner;";
          $rs = $pdo->query($sql);
          $ownerslist = $rs->fetchAll(PDO::FETCH_ASSOC);
          
          foreach ($ownerslist as $owner)
          {
            echo "<option value=\"" . $owner['OwnerID'] . "\">" . $owner['OwnerName'] . "</option>";
          }
        ?>
        </select>
        
        
        <div id="emailcaption" class="form-text">We probably won't sell your data.</div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>