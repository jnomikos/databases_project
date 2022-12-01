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
    <h1>Dashboard</h1>
    <a class = "nav-link" href="inventory.php"><u>Inventory</u></a>
    <br>
    <a class = "nav-link" href="emporders.php"><u>Orders</u></a>
    <br>
    
  </div>
</body>

</html>