<?php 
// include('default.php');
include('header.php');
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

  <!-- checkout-area start -->
  <div class="checkout-area pb-80 pt-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="checkout-wrapper">
            <div id="faq" class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Checkout method</a></h5>
                </div>
                <div id="payment-1" class="panel-collapse collapse show">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="checkout-login">
                          <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                          </div>
                          <p>&nbsp;</p>
                          <form>
                            <div class="login-form">
                              <label>Email Address * </label>
                              <input type="email" name="email">
                            </div>
                            <div class="login-form">
                              <label>Password *</label>
                              <input type="password" name="email">
                            </div>
                          </form>
                          <div class="checkout-login-btn">
                            <a href="#">Login</a>
                            <a href="#" style="background-color: #e02c2b;color:#fff;">Register Now</a>
                          </div>
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
                <div id="payment-2" class="panel-collapse collapse ">
                  <div class="panel-body">
                    <div class="billing-information-wrapper">
                      <div class="row">
                        <div class="col-lg-3 col-md-6">
                          <div class="billing-info">
                            <label>First Name</label>
                            <input type="text">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                          <div class="billing-info">
                            <label>Email Address</label>
                            <input type="email">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                          <div class="billing-info">
                            <label>Mobile</label>
                            <input type="email">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                          <div class="billing-info">
                            <label>Zip/Postal Code</label>
                            <input type="text">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="billing-info">
                            <label>Address</label>
                            <input type="text">
                          </div>
                        </div>
                      </div>
                        
                      <div class="ship-wrapper">
                        <div class="single-ship">
                          <input type="radio" name="address" value="address" checked="">
                          <label>Cash on Delivery(COD)</label>
                        </div>
                        <!--<div class="single-ship">
                          <input type="radio" name="address" value="dadress">
                          <label>Ship to different address</label>
                        </div>-->
                      </div>
                      <div class="billing-back-btn">
                        <div class="billing-btn">
                          <button type="submit">Place Your Order</button>
                        </div>
                      </div>
                    </div>
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
                <li class="single-shopping-cart">
                  <div class="shopping-cart-img">
                    <a href="#"><img alt="" src="front_assets/img/cart/cart-1.jpg"></a>
                  </div>
                  <div class="shopping-cart-title">
                    <h4><a href="#">Phantom Remote </a></h4>
                    <h6>Qty: 02</h6>
                    <span>$260.00</span>
                  </div>
                </li>
                <li class="single-shopping-cart">
                  <div class="shopping-cart-img">
                    <a href="#"><img alt="" src="front_assets/img/cart/cart-2.jpg"></a>
                  </div>
                  <div class="shopping-cart-title">
                    <h4><a href="#">Phantom Remote</a></h4>
                    <h6>Qty: 02</h6>
                    <span>$260.00</span>
                  </div>
                </li>
              </ul>
              <div class="shopping-cart-total">
                <h4>Total : <span class="shop-total">$260.00</span></h4>
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
