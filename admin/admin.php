<?php
include('../database.php');
include('../function.php');

session_start();

if(!isset($_SESSION['admin_nm'])){
  redirect('../login.php');
  //header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panle</title>

  <!--CSS Link-->
  <link rel="stylesheet" href="assets/css/style.css">  
</head>
<body>
  <div class="admin_container">
    <div class="content">
      <h3>Hi, <span>admin</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['admin_nm'] ?></span></h1>
      <p>This is an Admin Panel</p>
      <a href="../login.php" class="btn">Login</a>
      <a href="../signup.php" class="btn">Signup</a>
      <a href="../logout.php" class="btn">Logout</a>
    </div>
  </div>
</body>
</html>