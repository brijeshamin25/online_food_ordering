<?php 
include('config.php');
?>

<form action="submit.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key = "<?php echo $publishablekey ?>"
    data-amount = "2000"
    data-name = "The Eatery"
    data-description = "Testing Payment"
    data-image = "https://w7.pngwing.com/pngs/743/757/png-transparent-the-eatery-hd-logo-thumbnail.png"
    data-currency = "usd"
    data-email="birjesh@gmail.com"
  >
  </script>
</form>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Payment Example</h1>

  <form action="submit.php" method="post">
    <p>Paneer Pizza</p>
    <p>
      <strong>US $ 20.00</strong>
    </p>

    <button>Pay</button>
  </form>
</body>
</html> -->