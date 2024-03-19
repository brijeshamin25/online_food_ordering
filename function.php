<?php
function pr($arr){
  echo '<pre>';
  print_r($arr);
}

function prx($arr){
  echo '<pre>';
  print_r($arr);
  die();
}

function redirect($page){
  ?>
  <script>
    window.location.href='<?php echo $page?>';
  </script>
  <?php
  die();
}

function safe_valueto($val){
  global $con;
  $val = mysqli_real_escape_string($con, $val);
  return $val;
}

function send_email($email,$html,$subject){
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="aminbrijesh97@gmail.com";
	$mail->Password="bzzg ztzy mria gqqu";
	$mail->setFrom("aminbrijesh97@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject=$subject;
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "done";
	}else{
		//echo "Error occur";
	}
}

function random_str(){
  $str = str_shuffle('abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz');
  return $str = substr($str,0,12);
}

function get_cart(){
	global $con;
	$arr = array();
	$id = $_SESSION['USER_ID'];
	$cart_sele_sql = "select * from food_cart where customer_id = '$id'";
	$cart_sele_resu = mysqli_query($con,$cart_sele_sql);

	while($cart_row = mysqli_fetch_assoc($cart_sele_resu)){
		$arr[]=$cart_row;
	}
	return $arr;
}

function manage_cart($uid,$qty,$attr){
	global $con;
	$cart_sel_sql = "select * from food_cart where customer_id = '$uid' and food_item_id = '$attr'";
	$ct_sel_res = mysqli_query($con,$cart_sel_sql);
	if(mysqli_num_rows($ct_sel_res) > 0){
		$cart_row = mysqli_fetch_assoc($ct_sel_res);
		$ct_id = $cart_row['food_cart_id'];
		$cart_update_sql = "update food_cart set food_qty = '$qty' where food_cart_id = '$ct_id'";
		$ct_up_res = mysqli_query($con,$cart_update_sql); 
	}else{
		$cart_insert_sql = "insert into food_cart(food_qty,customer_id,	food_item_id) values('$qty','$uid','$attr')";
		$cart_ins_res = mysqli_query($con,$cart_insert_sql);
	}
}

function get_cart_detail($att_id=''){
	$cartArry = array();
	if(isset($_SESSION['USER_ID'])){
		$get_cart = get_cart();
		$cartArry = array();
		foreach($get_cart as $list){
			$cartArry[$list['food_item_id']]['food_qty']=$list['food_qty'];
		}
	}else{
		if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
			$cartArry = $_SESSION['cart'];
		}
	}if($att_id != ''){
		return $cartArry[$att_id]['food_qty'];
	}else{
		return $cartArry;
	}
}
?>