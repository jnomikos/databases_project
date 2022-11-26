<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logging In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
  </script>
<?php 
  include "credentials.php";

  try { 
  
    session_start();
    
    $pdo = new PDO($dsn, $username, $password);
    
    //Set Error Mode to Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Query and fetch data
    $email = $_POST['inputemail'];
    $rs = $pdo->prepare("SELECT * FROM Customer WHERE Email = ?;");
    $rs->execute(array($email));
    $userdata = $rs->fetchAll(PDO::FETCH_ASSOC);
    
    if($userdata)
    {
      $_SESSION['user']=$email;
      header("Location:index.php");
    }
    else 
    {
      echo "Invalid email address.";
    }
  }
  catch(PDOexception $e) 
  {
    echo "Connection to database failed: " . $e->getMessage();
  }
?>
</body>
</html>
