<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
 
  
</head>
<body>
  <div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>
            <li><a href="index.php">Home</a></li>

            <?php if(!isset($_SESSION["loggedin"])) { ?>
              <li><a href="login.php">Log In</a></li>
            <?php } else { ?>
              <li><a href="dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php } ?>
            
            <!-- <li><a href="register.php">Sign Up</a></li>
            <li><a href="#">Contact</a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>

  <header class="showcase">
    <div class="container showcase-inner">
      <h1>Welcome</h1>
     
      <!-- <a href="#" class="btn">Read More</a> -->
    </div>
  </header>
</body>
</html>