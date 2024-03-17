<?php
include('../database.php');
include('../function.php');
include('../default.php');

session_start();

$str = $_SERVER['REQUEST_URI'];
$strArry = explode('/', $str);
$path = $strArry[count($strArry)-1];

if(!isset($_SESSION['admin_nm'])){
  redirect('../login.php');
}

$title = '';
if($path == '' || $path == 'admin.php'){
  $title = 'Admin Panel';
}elseif($path == 'menu.php'){
  $title = 'Menu';
}elseif($path == 'add_menu.php'){
  $title = 'Manage Menu';
}elseif($path == 'food.php'){
  $title = 'Food';
}elseif($path == 'add_food.php'){
  $title = 'Manage Food';
}elseif($path == 'customer.php'){
  $title = 'Users';
}elseif($path == 'slider.php'){
  $title = 'Slider';
}elseif($path == 'add_slider.php'){
  $title = 'Manage Slider';
}elseif($path == 'contact_us.php'){
  $title = 'Contact Us';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title ?></title>
  
  <!-- inject:css -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.9.55/css/materialdesignicons.min.css">

  <link rel="stylesheet" href="assets/css/fonts.css">

  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- <link rel="stylesheet" href="assets/css/style1.css"> -->
  <!-- <link rel="stylesheet" href="assets/css/ref.css">  -->
  <link rel="stylesheet" href="assets/css/style1_old.css">


</head>
<body class="sidebar-light">
  <div class="container-scroller"> 
    <nav class="navbar col col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
           
          </button>
          </li>  
        </ul>

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="admin.php"><img src="assets/images/the-eatery.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="assets/images/the-eatery.svg" alt="logo"/></a>
        </div>

        <ul class="navbar-nav navbar-nav-right">  
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"><?php echo $_SESSION['admin_nm'] ?></span>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider">
              </div>
              <a class="dropdown-item" href="../logout.php">
                <i class="mdi mdi-logout"></i>
                Logout
              </a>
            </div>
          </li>
          
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">
              <i class="mdi mdi-monitor-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

		      <li class="nav-item">
            <a class="nav-link" href="menu.php">
              <i class='bx bxs-food-menu menu-icon' > </i>
              <span class="menu-title">Menu</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="food.php">
              <i class="mdi mdi-food menu-icon"></i>
              <span class="menu-title">Food Items</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="customer.php">
              <i class='bx bxs-user-account menu-icon'></i>
              <span class="menu-title">Users</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="slider.php">
              <i class='bx bxs-image menu-icon' ></i>
              <span class="menu-title">Slider</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">
              <i class='bx bxs-contact menu-icon'></i>
              <span class="menu-title">Contact Us</span>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class='bx bx-notepad menu-icon'></i>
              <span class="menu-title">Order</span>
            </a>
          </li> --> 
          
        </ul>
      </nav>
      
    <div class="main-panel">
        <div class="content-wrapper">

</body>
</html>
