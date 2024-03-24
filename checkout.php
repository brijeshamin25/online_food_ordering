<?php 
// include('default.php');
include('header.php');

$cartArry = get_cart_detail();

if(count($cartArry)>0){
  
}else{
  redirect(FRONTEND_SITE_PATH.'main');
}

if(isset($_SESSION['USER_ID'])){
  $is_show = '';
  $is_login = '';
  $active_show = 'show';
  $other_log_id= 'payment-2';
}else{
  $is_show = 'show';
  $is_login = 'payment-1';
  $active_show = '';
  $other_log_id= '';
}

$userArry = getUserInfo();

if(isset($_POST['place_order'])){
  prx($_POST);
  $checkout_fname = safe_valueto($_POST['checkout_fname']);
  $checkout_lname = safe_valueto($_POST['checkout_lname']);
  $checkout_email = safe_valueto($_POST['checkout_email']);
  $checkout_phone = safe_valueto($_POST['checkout_phone']);
  $checkout_zip = safe_valueto($_POST['checkout_zip']);
  $checkout_address = safe_valueto($_POST['checkout_address']);
  $payment_type = safe_valueto($_POST['payment_type']);
  $added_on = date('Y-m-d h:i:s');

  $order_ins_sql = "insert into order_master(customer_id,first_name,last_name,address,zip_code,phone,email,total_price,payment_status,order_status,payment_type,added_on) values('".$_SESSION['USER_ID']."','$checkout_fname','$checkout_lname','$checkout_address','$checkout_zip','$checkout_phone','$checkout_email','$totalPrice','pending','1','$payment_type',NOW())";

  mysqli_query($con,$order_ins_sql);
  $insert_id = mysqli_insert_id($con);
  $_SESSION['ORDER_ID'] =$insert_id;
  foreach($cartArry as $key=>$val){
    $ord_itm_ins_sql = "insert into `order_item`(order_id,food_item_id,	price,qty) values('$insert_id','$key','".$val['price']."','".$val['food_qty']."')";
    $ord_itm_ins_res = mysqli_query($con,$ord_itm_ins_sql);
  }
  emptyCart();
  $getUserInfo = getUserInfo();
	$email = $getUserInfo['email'];

  if($payment_type == 'cod'){
    $emailHTML = orderPlacedEmail($insert_id);
    include('smtp/PHPMailerAutoload.php');
    send_email($email,$emailHTML,'Order Placed');
    redirect(FRONTEND_SITE_PATH.'success');
  }

  if($payment_type == 'card'){
    
  }
  
  // prx($cartArry);

  // prx($_POST);
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
          <li class="active"> Checkout </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="checkout-area pb-25 pt-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="checkout-wrapper">
            <div id="faq" class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Checkout method</a></h5>
                </div>
                <div id="<?php echo $is_login ?>" class="panel-collapse collapse <?php echo $is_show ?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="checkout-login">
                          <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                          </div>
                          <p>&nbsp;</p>
                          <form method="post" id="formLogin">
                            <div class="login-form">
                              <label>Email Address * </label>
                              <input type="email" placeholder="Enter Email" class="input" name="user_email" required>
                            </div>

                            <div class="login-form">
                              <label>Password *</label>
                              <div class="items input_div">
                                <input type="password" placeholder="Enter Password" class="password" name="user_password" required>
                                <i class='bx bx-hide hide_icone'></i>
                              </div>
                            </div>                          
                            <div class="checkout-login-btn">
                              <input type="submit" name="submit" id="login_submit_btn" value="login" class="checkout_login"/>
                              
                              <a href="<?php echo FRONTEND_SITE_PATH?>login_signup" style="background-color: #e02c2b;color:#fff;">Register Now</a>
                            </div>

                            <input type="hidden" name="sign_reg" value="login_msg"/>
                            <input type="hidden" name="is_checkout" id="is_checkout" value="yes"/>

                            <span id="email_error" class="errMsg"></span>

                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">Other information</a></h5>
                </div>
                <div id="<?php echo $other_log_id ?>" class="panel-collapse collapse <?php echo $active_show ?>">
                  <div class="panel-body">
                    <form method="post">
                      <div class="billing-information-wrapper">
                        <div class="row">
                          <div class="col-lg-2 col-md-6">
                            <div class="billing-info">
                              <label>First Name</label>
                              <input type="text" name="checkout_fname" value="<?php echo $userArry['fname']?>" required>
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6">
                            <div class="billing-info">
                              <label>Last Name</label>
                              <input type="text" name="checkout_lname" value="<?php echo $userArry['lname']?>" required>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-6">
                            <div class="billing-info">
                              <label>Email Address</label>
                              <input type="email" name="checkout_email" value="<?php echo $userArry['email']?>" required>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6">
                            <div class="billing-info">
                              <label>Phone</label>
                              <input type="number" name="checkout_phone" value="<?php echo $userArry['phone']?>" required>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6">
                            <div class="billing-info">
                              <label>Zip/Postal Code</label>
                              <input type="text" name="checkout_zip" required>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="billing-info">
                              <label>Address</label>
                              <input type="text" name="checkout_address" required>
                            </div>
                          </div>
                        </div>
                          
                        <div class="ship-wrapper">
                          <div class="single-ship">
                            <input type="radio" name="payment_type" value="cod" >
                            <label>Cash on Delivery(COD)</label>
                          </div>

                          <div class="single-ship">
                            <input type="radio" name="payment_type" value="card" checked="checked">
                            <label>Pay With Card</label>
                          </div>
                          <!--<div class="single-ship">
                            <input type="radio" name="address" value="dadress">
                            <label>Ship to different address</label>
                          </div>-->
                        </div>
                        <div class="billing-back-btn">
                          <div class="billing-btn">
                            <button type="submit" name="place_order">Place Your Order</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>                 
            </div>
          </div>
        </div>
        
        <div class="col-lg-3">
          <div class="checkout-progress">
            <div class="shopping-cart-content-box">
              <h4 class="checkout_title">Cart Details</h4>
              <ul>
                <?php foreach($cartArry as $key=>$list){ ?>
                  <li class="single-shopping-cart">
                    <div class="shopping-cart-img">
                      <a href="#"><img alt="" src="<?php echo SITE_FOOD_IMG_CALL.$list['image']?>"></a>
                    </div>
                    <div class="shopping-cart-title">
                      <h4><a href="#"><?php echo $list['name']?> </a></h4>
                      <h6>Qty: <?php echo $list['food_qty']?></h6>
                      <span>$<?php echo $list['food_qty']*$list['price']; ?></span>
                    </div>
                  </li>
                <?php 
                }
                ?>
              </ul>
              <div class="shopping-cart-total">
                <h4>Total : <span class="shop-total">$ <?php echo $totalPrice ?></span></h4>
              </div>
            </div>
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
