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
      <img src="logoipsum.png">
    </div>
  </nav>

  <!-- Checkout display form -->
  <div class="container-fluid bg-light text-dark text-center border-top border-bottom w-50">
    <h2>Checkout:</h2>
    <h4>Your total is: some dollars</h4>
    <form action="submitorder.php" method="post">
      <div class="mb-3">
        <label for="inputaddr" class="form-label">Shipping address</label>
        <input type="text" class="form-control" name = "inputaddr">
        <br>
        <label for="inputcc" class="form-label">Credit Card Number</label>
        <input type="text" class="form-control" name = "inputcc">
        <br>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
    
  </div>

</body>

</html>