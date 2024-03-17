<?php 
include('database.php');
include('function.php');
include('default.php');
include('smtp/PHPMailerAutoload.php');

session_start();


$sign_reg = safe_valueto($_POST['sign_reg']);

if ($sign_reg == 'register') {
  $fname = safe_valueto($_POST['fname']);
  $lname = safe_valueto($_POST['lname']);
  $email = safe_valueto($_POST['email']);
  $phone = safe_valueto($_POST['phone']);
  $password = safe_valueto($_POST['password']);
  $compassword = safe_valueto($_POST['compassword']);

  $verify = mysqli_num_rows(mysqli_query($con, "SELECT * FROM customer WHERE email = '$email'"));
  if ($verify > 0) {
    $arr = array('status' => 'error', 'msg' => 'Email ID Already Exists 😞', 'field' => 'email_error');
    echo json_encode($arr);
  }else if($password !== $compassword){
    $arr = array('status' => 'error', 'msg' => 'Password Not Matched!!🙄', 'field' => 'pass_error');
    echo json_encode($arr);
  } else {
    $new_pass = password_hash($password,PASSWORD_BCRYPT);
    $random_str = random_str();
    $cont_ins_sql = "INSERT INTO customer(fname, lname, email, phone, password, compassword, cust_status, email_verify,random_str) VALUES ('$fname', '$lname', '$email', '$phone', '$new_pass', '$new_pass', '1', '0','$random_str')";
    $cont_res = mysqli_query($con, $cont_ins_sql);

    $id = mysqli_insert_id($con);
    $html=FRONTEND_SITE_PATH."email_verify.php?id=".$random_str;
    send_email($email,$html,'Please Verify your E-mail id');

    if ($cont_res) {
        echo json_encode(array('status' => 'success', 'msg' => 'Thank you, Please check your email to verify your account ✌️','field' => 'signup_form_msg'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Error occurred during registration','field' => 'signup_form_msg')); // Handle registration failure
    }
  } 
}

if ($sign_reg == 'login_msg') {
  $email = safe_valueto($_POST['user_email']);
  $password = safe_valueto($_POST['user_password']);
  
  $log_sele_sql = "SELECT * FROM customer WHERE email = '$email'";
  $log_res = mysqli_query($con, $log_sele_sql);
  $verify = mysqli_num_rows($log_res);
  if ($verify > 0) {
    $row = mysqli_fetch_assoc($log_res);
    $cust_status = $row['cust_status'];
    $email_verify = $row['email_verify'];
    $enc_password = $row['password'];

    if($email_verify == 1){
      if($cust_status == 1){
        if(password_verify($password,$enc_password)){
          $_SESSION['USER_ID']=$row['cust_id'];
          $_SESSION['USER_NAME']=$row['fname'];
          $arr = array('status' => 'success', 'msg' => '');
        }else{
          $arr = array('status' => 'error', 'msg' => 'Please enter Correct Password... 👀');
        }
      }else{
        $arr = array('status' => 'error', 'msg' => 'Sorry, Your account has been deactivated... 😞');
      }
    }else{
      $arr = array('status' => 'error', 'msg' => 'Please Verify your email id... 📩');
    }
  }else{
    $arr = array('status' => 'error', 'msg' => 'Please enter valid Login details... 🫡');
  }
  echo json_encode($arr);
}

?>
