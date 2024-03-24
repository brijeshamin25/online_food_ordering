<?php 
include('header.php');

if(isset($_GET['order_master_id']) && $_GET['order_master_id'] > 0){
  $id = safe_valueto($_GET['order_master_id']);

	if(isset($_GET['order_status'])){
		$order_status = safe_valueto($_GET['order_status']);
		$order_upd_sql = "update order_master set order_status = '$order_status' where order_master_id='$id'";
		$order_upd_res = mysqli_query($con,$order_upd_sql);
		redirect(FRONTEND_SITE_PATH.'admin/order_detail.php?order_master_id='.$id);
	}

	$all_data_sql = "select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.order_status_id and  order_master.order_master_id = '$id' order by order_master.order_master_id desc";
	$res = mysqli_query($con, $all_data_sql);
	if(mysqli_num_rows($res) > 0){
		$order_row = mysqli_fetch_assoc($res);
		//prx($order_row);
	}
}else{
	redirect('index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
  <div class="page-header">
		<h3 class="page-title"> Invoice </h3>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="card px-2">
				<div class="card-body">
					<div class="container-fluid">
						<h3 class="text-right my-5">Order ID&nbsp;&nbsp; <?php echo $id?></h3>
						<hr>
					</div>
					
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-3 pl-0">
							<p class="mt-5 mb-2"><b>The Eatery</b></p>
							<p>777 <br>Hollywood Blvd. <br> Limrick, PA - 19641</p>
						</div>
						
						<div class="col-lg-3 pr-0">
							<p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
							<p class="text-right">
								<?php echo $order_row['first_name']?>
								<?php echo $order_row['last_name']?><br>
								<?php echo $order_row['address']?><br>
								<?php echo $order_row['zip_code']?><br>
								<?php echo $order_row['email']?><br>
								<?php echo 'PA' ?>
							</p>
						</div>
					</div>
					
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-3 pl-0">
							<p class="mb-0 mt-5">Order Date : <?php echo dateFormat($order_row['added_on']) ?> </p>
						</div>
					</div>
					
					<div class="container-fluid mt-5 d-flex justify-content-center w-100">
						<div class="table-responsive w-100">
							<table class="table">
								<thead>
									<tr class="bg-dark">
										<th>#</th>
										<th>Description</th>
										<th class="text-right">Quantity</th>
										<th class="text-right">Unit cost</th>
										<th class="text-right">Total</th>
									</tr>
								</thead>
								
								<tbody>
									<?php 
										$getOrderData = getOrderData($id);
										$i = 1;
										$tp = 0;
										foreach($getOrderData as $list){ 
											$tp = $tp + ($list['price']*$list['qty']);	
										?>
										<tr class="text-right">
											<td class="text-left"><?php echo $i ?></td>
											<td class="text-left"><?php echo $list['food_name']?> (<?php echo $list['food_attribute']?>)</td>
											<td><?php echo $list['qty']?></td>
											<td>$ <?php echo $list['price']?></td>
											<td>$ <?php echo $list['price']*$list['qty']?></td>
										</tr>
									<?php
									$i++; 
									} 
									?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="container-fluid mt-5 w-100">
						<h4 class="text-right mb-5">Total : $ <?php echo $tp?></h4>

						<hr>
					</div>

					<div class="container-fluid w-100">
						<a href="../download_invoice.php?order_master_id=<?php echo $id?>" class="btn btn-primary float-right mt-4 ml-2"><i class="mdi mdi-printer mr-1"></i>PDF</a>
					</div>
					
					<?php 
						$order_sts_sql = "select * from order_status order by order_status desc";
						$order_sts_res = mysqli_query($con,$order_sts_sql);
					?>
					<div>
						<?php 
							echo "<h5 style='margin-bottom: 1.2rem;'> Order Status => <span style='color:red'>".$order_row['order_status_str']."</span></h5>";
						?>
						<select class="form-control wSelect200" name="order_status" id="order_status" style="margin-top:2.2 rem; margin-left:1.2rem;" onchange="updateOrderStatus()">
							<option val=''>Update Order Status</option>
							<?php 
								while($order_sts_row = mysqli_fetch_assoc($order_sts_res)){
									echo "<option value=".$order_sts_row['order_status_id'].">".$order_sts_row['order_status']."</option>";
								}
							?>
						</select>
					</div>					
				</div>  
			</div>
		</div>
	</div> 
	<script>
		function updateOrderStatus(){
			var oder_sts=jQuery('#order_status').val();
			if(order_status != ''){
				var od_id="<?php echo $id ?>";
				window.location.href = '<?php echo FRONTEND_SITE_PATH?>admin/order_detail.php?order_master_id='+od_id+'&order_status='+oder_sts;
			}
			
		}
	</script> 
</body>
</html>   
<?php include('footer.php');?>