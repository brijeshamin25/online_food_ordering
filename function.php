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
			$getFoodItemId = getFoodItemId($list['food_item_id']);
			$cartArry[$list['food_item_id']]['price']=$getFoodItemId['price'];
			$cartArry[$list['food_item_id']]['name']=$getFoodItemId['food_name'];
			$cartArry[$list['food_item_id']]['image']=$getFoodItemId['images'];
		}
	}else{
		if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
			foreach($_SESSION['cart'] as $key => $val){
				$cartArry[$key]['food_qty']=$val['qty'];
				$getFoodItemId = getFoodItemId($key);
				$cartArry[$key]['price']=$getFoodItemId['price'];
				$cartArry[$key]['name']=$getFoodItemId['food_name'];
				$cartArry[$key]['image']=$getFoodItemId['images'];
			}
		}
	}if($att_id != ''){
		return $cartArry[$att_id]['food_qty'];
	}else{
		return $cartArry;
	}
}

function getFoodItemId($id){
	global $con;
	$prs_sel_sql = "select food.food_name,food.images,food_item.price from food_item,food where food_item.food_item_id='$id' and food.food_id = food_item.food_id";
	$prs_sel_res = mysqli_query($con,$prs_sel_sql);
	$prs_row = mysqli_fetch_assoc($prs_sel_res);
	return $prs_row;
}

function getUserInfo(){
  global $con;
	$data['fname'] = '';
	$data['lname'] = '';
	$data['email'] = '';
	$data['phone'] = '';

	if(isset($_SESSION['USER_ID'])){
		$cst_sel_sql = "select * from customer where cust_id=".$_SESSION['USER_ID'];
		$cst_sel_res = mysqli_query($con,$cst_sel_sql);
		$cst_sel_row = mysqli_fetch_assoc($cst_sel_res);
		$data['fname'] = $cst_sel_row['fname'];
		$data['lname'] = $cst_sel_row['lname'];
		$data['email'] = $cst_sel_row['email'];
		$data['phone'] = $cst_sel_row['phone'];
	}
	return $data;
}

function emptyCart(){
	if(isset($_SESSION['USER_ID'])){
		global $con;
		$cst_del_sql = "delete from food_cart where customer_id=".$_SESSION['USER_ID'];
		$cst_del_res = mysqli_query($con,$cst_del_sql);
	}else{
		unset($_SESSION['cart']);
	}
}

function removeFoodFromCart($id){
	if(isset($_SESSION['USER_ID'])){	
		global $con;
		$cart_itm_del_sql = "delete from food_cart where food_item_id='$id' and customer_id=".$_SESSION['USER_ID'];
		$cart_itm_del_res = mysqli_query($con,$cart_itm_del_sql);
	}else{
		unset($_SESSION['cart'][$id]);
	}
}
?>