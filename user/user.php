<?php
include('../database.php');
include('../function.php');

session_start();

if(!isset($_SESSION['cust_nm'])){
  //header('location:login.php');
  redirect('../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Panle</title>

  <!--CSS Link-->
  <link rel="stylesheet" href="../admin/assets/css/style.css">  
</head>
<body>
  <div class="admin_container">
    <div class="content">
      <h3>Hi, <span>User</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['cust_nm'] ?></span></h1>
      <p>This is an User Panel</p>
      <a href="../login.php" class="btn">Login</a>
      <a href="../signup.php" class="btn">Signup</a>
      <a href="../logout.php" class="btn">Logout</a>
    </div>
  </div>
</body>
</html>