<?php 
include('database.php');
include('function.php');
include('default.php');

session_start();
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo FRONTEND_WEBSITE_NAME ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="front_assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="front_assets/css/animate.css">
  <link rel="stylesheet" href="front_assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="front_assets/css/slick.css">
  <link rel="stylesheet" href="front_assets/css/chosen.min.css">
  <link rel="stylesheet" href="front_assets/css/ionicons.min.css">
  <link rel="stylesheet" href="front_assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="front_assets/css/simple-line-icons.css">
  <link rel="stylesheet" href="front_assets/css/jquery-ui.css">
  <link rel="stylesheet" href="front_assets/css/meanmenu.min.css">
  <link rel="stylesheet" href="front_assets/css/style.css">
  <link rel="stylesheet" href="front_assets/css/responsive.css">
  <script src="front_assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
  <header class="header-area">
    <div class="header-top black-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12 col-sm-4">
            <div class="welcome-area">
              <p>Welcome to Brijesh Restaurant </p>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-12 col-sm-8">
            <div class="account-curr-lang-wrap f-right">
              <ul>
                <li class="top-hover"><a href="#">Setting  <i class="ion-chevron-down"></i> </a>
                  <ul>
                    <li><a href="profile.php">My Account</a></li>
                    <li><a href="order_history.php">Order History</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="header-middle">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12 col-sm-4">
            <div class="logo">
              <a href="index.html">
                <img alt="" src="assets/img/logo/logo.png">
              </a>
            </div>
          </div>
          <div class="col-lg-9 col-md-8 col-12 col-sm-8">
            <div class="header-middle-right f-right">
              <div class="header-login">
                <a href="login.php">
                  <div class="header-icon-style">
                    <i class="icon-user icons"></i>
                  </div>
                  <div class="login-text-content">
                    <p>Register <br> or <span>Sign in</span></p>
                  </div>
                </a>
              </div>
              <div class="header-wishlist">
                &nbsp;
              </div>
              <div class="header-cart">
                <a href="#">
                  <div class="header-icon-style">
                    <i class="icon-handbag icons"></i>
                    <span class="count-style">0</span>
                  </div>
                  <div class="cart-text">
                    <span class="digit">My Cart</span>
                    <span class="cart-digit-bold"></span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="header-bottom transparent-bar black-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="main-menu">
              <nav>
                <ul>
                  <li><a href="main.php">Home</a></li>
                  <li><a href="about_us.php">About Us</a></li>
                  <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="mobile-menu">
              <nav id="mobile-menu-active">
                <ul class="menu-overflow" id="nav">
                  <li><a href="main.php">Home</a></li>
                  <li><a href="about_us.php">About Us</a></li>
                  <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</body>
</html>