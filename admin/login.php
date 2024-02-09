<?php
include ('database.php');
session_start();

if(isset($_POST['submit'])){
  // $fnm = mysqli_real_escape_string($con, $_POST['fname']);
  // $lnm = mysqli_real_escape_string($con, $_POST['lname']);
  $eml = mysqli_real_escape_string($con, $_POST['email']);
  $pass = md5($_POST['password']);
  // $cpass = md5($_POST['compassword']);
  $user_type = $_POST['user_feild'];

  $sql = "select * from reg_login where email = '$eml' and password = '$pass'";

  $res = mysqli_query($con,$sql);
  
  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_array($res);

    if($row['user_feild'] === 'admin'){
      $_SESSION['admin_nm'] = $row['name'];
      header('location:admin.php');
    }elseif($row['user_feild'] === 'customer'){
      $_SESSION['cust_nm'] = $row['name'];
      header('location:../user/user.php');
    }

  }else{
    $error[] = "Incorrect Email or Password..!!";
  }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Ordering Login</title>

  <!-- Boxicons Link-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- CSS Link -->
  <link rel="stylesheet" href="assets/css/login.css" />
  <link rel="stylesheet" href="assets/css/fonts.css">
</head>
<body>
    <section class="container forms">
      <div class="outter_form_div login">
        <div class="form_details">
          <h3>Login</h3>
          
          <?php 
            if(isset($error)){
              foreach($error as $error){
                echo'<span class="err_msg">'.$error.'</span>';
              }
            }
          ?>

          <form action="" method="post">
            <div class="items input_div">
              <input type="email" placeholder="Enter Email" class="input" name="email">
            </div>

            <div class="items input_div">
              <input type="password" placeholder="Enter Password" class="password" name="password">
              <i class='bx bx-hide hide_icone'></i>
            </div>

            <input type="submit" name="submit" value="Login" class="items button_div">

            <div class="form_link">
              <span>Don't have an account? <a href="signup.php" class="link signup_link">Signup</a></span>
            </div>
          </form>

        </div>
      </div>
    </section>

    <!--JS Links-->
    <script src="assets/js/script.js"></script>
</body>
</html>