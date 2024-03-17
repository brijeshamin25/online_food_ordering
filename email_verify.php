<?php 
// include('default.php');
include('header.php');

$verify_msg = '';

if(isset($_GET['id']) && $_GET['id']!=''){
  $id=safe_valueto($_GET['id']);
  $eml_sts_upd_sql = "update customer set email_verify=1 where random_str='$id'";
  $emlsts_res = mysqli_query($con, $eml_sts_upd_sql);
  $verify_msg = "Thank you for Sign up and Verifying!";
}else{
  redirect('index.php');
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
</head>
<body>
  <div class="breadcrumb-area gray-bg">
    <div class="container">
      <div class="breadcrumb-content">
        <ul>
          <li><a href="<?php echo FRONTEND_SITE_PATH?>index">Home</a></li>
          <li class="active"> Email Verify </li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="contact-area pt-100 pb-100">
    <div class="container">
      
      <div class="row">
        <div class="col-12">
          <div class="contact-message-wrapper">
            <h4 class="contact-title">
              <?php 
                echo $verify_msg;
              ?>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php
include('footer.php');
?>
