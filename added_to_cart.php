<?php 
include('database.php');
include('function.php');
include('default.php');

session_start();

$qty = safe_valueto($_POST['qty']);
$attr = safe_valueto($_POST['attr']);
$cart_type = safe_valueto($_POST['cart_type']);

if($cart_type == 'add'){
  if(isset($_SESSION['USER_ID'])){
    $uid = $_SESSION['USER_ID'];
    manage_cart($uid,$qty,$attr);
  }else{
    $_SESSION['cart'][$attr]['qty']=$qty;
  }
}
?>