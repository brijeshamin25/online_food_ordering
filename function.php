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
  return $str = substr($str,0,20);
}
?>