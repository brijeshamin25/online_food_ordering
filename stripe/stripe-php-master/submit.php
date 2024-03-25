<?php 
include('config.php');

echo '<pre>';
print_r($_POST);


// if(isset($_POST['stripeToken'])){
//   $token = $_POST['stripeToken'];
//   $data = \Stripe\Charge::create(array(
//     "amount" => 2000,
//     "currency" => "usd",
//     "description" => "Testing Payment",
//     "source" => $token,
//   ));
// }
?>