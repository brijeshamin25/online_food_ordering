<?php 
include('database.php');
include('function.php');
include('default.php');
include('vendor/autoload.php'); //convert to PDF

session_start();

if(!isset($_SESSION['USER_ID'])){
  redirect(FRONTEND_SITE_PATH.'main');
}

if(isset($_GET['order_id']) && $_GET['order_id'] > 0){
  $id = safe_valueto($_GET['order_id']);
  $emailHTML = orderPlacedEmail($id);

  $mpdf = new \Mpdf\Mpdf();
  $mpdf -> WriteHTML($emailHTML);
  $file = time().'.pdf';
  $mpdf -> Output($file,'D');
}
?>