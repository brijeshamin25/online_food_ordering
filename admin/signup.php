<?php
@include 'database.php';

if(isset($_POST['submit'])){
  $fnm = mysqli_real_escape_string($con, $_POST['fname']);
  $lnm = mysqli_real_escape_string($con, $_POST['lname']);
  $eml = mysqli_real_escape_string($con, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['compassword']);
  $user_type = $_POST['user_feild'];

  $sql = "select * from reg_login where email = '$eml' && password = '$pass'";

  $res = mysqli_query($con,$sql);
  
  if(mysqli_num_rows($res) > 0){
    $error[] = 'User already Exist!!';
  }else{
    if($pass != $cpass){
      $error[] = 'Password Not Matched!!';
    }else{
      $sql_insert = "insert into reg_login(fname,lname,email,password,user_type) values('$fnm','$lnm','$eml','$pass','$user_type')";
      mysqli_query($con,$sql_insert);
      header('location:login.php');
    }
  }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Form</title>

  <!-- Boxicons Link-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- CSS Link -->
  <link rel="stylesheet" href="assets/css/signup.css" />
  <link rel="stylesheet" href="assets/css/fonts.css">
</head>
<body>

  <div class="constiner_forms">
    <form action="" method="post">
      <h3>Sign Up</h3>
      
      <?php 
        if(isset($error)){
          foreach($error as $error){
            echo'<span class="err_msg">'.$error. '</span>';
          }
        }
      ?>

      <input type="text" name="fname" placeholder="Enter First Name" required>

      <input type="text" name="lname" placeholder="Enter Last Name" required>
      
      <input type="email" name="email" placeholder="Enter Email" required>
      
      <input type="password" name="password" placeholder="Enter Password" required>
      
      <input type="password" name="compassword" placeholder="Enter Comfirm Password" required>

      <select name="user_feild">
        <option value="customer">Customer</option>
        <option value="admin">Admin</option>
      </select>
      
      <input type="submit" name="submit" value="signup" class="button_div">

      <div class="form_link">
        <span>Already have an account? <a href="login.php" class="link signup_link">Login</a></span>
      </div>

    </form>
  </div>

    <!-- <section class="container forms">
      <div class="outter_form_div login">
        <div class="form_details">
          <header>Signup Form</header>

          <form action="#">
            <div class="items input_div">
              <input type="email" placeholder="Email" class="input">
            </div>

            <div class="items input_div">
              <input type="password" placeholder="Password" class="password">
              <i class='bx bx-hide hide_icone'></i>
            </div>
            
            <div class="items button_div">
              <button>Signup</button>
            </div>
          </form>

          <div class="form_link">
            <span>Already have an account? <a href="login.html" class="login_link">Login</a></span>
          </div>

        </div>
      </div>
    </section> -->

    <!--JS Links-->
    <script src="assets/js/script.js"></script>
</body>
</html>