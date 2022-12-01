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
  <title>Logging Out</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>
<?php 
  session_start();
  
  session_destroy();
  header("Location: index.php");
?>
</body>
</html>
