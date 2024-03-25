<?php 

include('header.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panle</title>

  
  <link rel="stylesheet" href="assets/css/style.css">  
</head>
<body>
  
  <!-- <div class="admin_container">
    <div class="content">
      <h3>Hi, <span>admin</span></h3>
      <h1>Welcome </h1>
      <p>This is an Admin Panel</p>
      <a href="../login.php" class="btn">Login</a>
      <a href="../signup.php" class="btn">Signup</a>
      <a href="../logout.php" class="btn">Logout</a>
    </div>
  </div> -->


  <div class="row">
	  <div class="col-md-6 col-lg-3 grid-margin stretch-card">
	    <div class="card">
		    <div class="card-body">
		      <h1 class="font-weight-light mb-4">$
            <?php
              $start = date('Y-m-d'). ' 00-00-00';
              $end = date('Y-m-d'). ' 23-59-59';
             echo getSales($start,$end);
             ?>
          </h1>
		      <div class="d-flex flex-wrap align-items-center">
            <div>
			        <h4 class="font-weight-normal">Total Sale</h4>  
            </div>
            <i class="mdi mdi-shopping icon-lg text-primary ml-auto"></i>
          </div>
        </div>
	    </div>
	  </div>
    
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
	    <div class="card">
		    <div class="card-body">
		      <h1 class="font-weight-light mb-4">$
            <?php
              $start = strtotime(date('Y-m-d'));
              $start = strtotime("-7 day",$start);
              $start = date('Y-m-d',$start);
              $end = date('Y-m-d'). ' 23-59-59';
              echo getSales($start,$end);
            ?>
          </h1>
		      <div class="d-flex flex-wrap align-items-center">
			      <div>
			        <h4 class="font-weight-normal">7 Days Sale</h4>
			        <p class="text-muted mb-0 font-weight-light">Last 7 Days Sale</p>
			      </div>
			      <i class="mdi mdi-shopping icon-lg text-danger ml-auto"></i>
		      </div>
		    </div>
      </div>
	  </div>
	  
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
	    <div class="card">
		    <div class="card-body">
		      <h1 class="font-weight-light mb-4">$
          <?php
              $start = strtotime(date('Y-m-d'));
              $start = strtotime("-30 day",$start);
              $start = date('Y-m-d',$start);
              $end = date('Y-m-d'). ' 23-59-59';
              echo getSales($start,$end);
            ?>
          </h1>
		      <div class="d-flex flex-wrap align-items-center">
			      <div>
			        <h4 class="font-weight-normal">30 Days Sale</h4>
			        <p class="text-muted mb-0 font-weight-light">Last 30 Days Sale</p>
			      </div>
			      <i class="mdi mdi-shopping icon-lg text-info ml-auto"></i>
		      </div>
		    </div>
      </div>
	  </div>
	  
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
	    <div class="card">
		    <div class="card-body">
		      <h1 class="font-weight-light mb-4"> $
            <?php
              $start = strtotime(date('Y-m-d'));
              $start = strtotime("-365 day",$start);
              $start = date('Y-m-d',$start);
              $end = date('Y-m-d'). ' 23-59-59';
              echo getSales($start,$end);
            ?>
          </h1>
		      <div class="d-flex flex-wrap align-items-center">
			      <div>
			        <h4 class="font-weight-normal">365 Days Sale</h4>
			        <p class="text-muted mb-0 font-weight-light">Last 365 Days Sale</p>
			      </div>
			      <i class="mdi mdi-shopping icon-lg text-success ml-auto"></i>
		      </div>
		    </div>
	    </div>
	  </div>
  </div>
  
  <?php 
  $all_data_sql = "select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.order_status_id order by order_master.order_master_id desc limit 5";
  $res = mysqli_query($con, $all_data_sql);
  ?>
  <div class="row">
	  <div class="col-12">
	    <div class="card">
		    <div class="card-body">
		      <h4 class="card-title">Latest 5 Order</h4>
		      <div class="table-responsive">
			      <table class="table table-hover">
			        <thead>
                <tr class= "order_table_title">
                  <th>Order ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Address/Zip Code</th>
                  <th>Email/Phone</th>
                  <th>Price</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th>Added On</th>
                </tr>
              </thead>
			        <tbody>
                <?php if(mysqli_num_rows($res) > 0){ 
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                  <td>
                    <div class="order_dtl_link_id">
                      <a title="View Order Details" href="order_detail.php?order_master_id=<?php echo $row['order_master_id'] ?>"><?php echo $row['order_master_id'] ?></a>
                    </div>
                  </td>
                  <td><?php echo $row['first_name'] ?></td>
                  <td><?php echo $row['last_name'] ?></td>
                  <td>
                    <p><?php echo $row['address'] ?></p>
                    <p><?php echo $row['zip_code'] ?></p>
                  </td>	
                  <td>
                    <p><?php echo $row['email'] ?></p>
                    <p><?php echo $row['phone'] ?></p>
                  </td>	
                  <td>$ <?php echo $row['total_price'] ?></td>
                  <td>
                    <div class="payment_status payment_status_<?php echo $row['payment_status']?>"><?php echo ucfirst($row['payment_status']) ?></div>
                  </td>
                  <td><?php echo $row['order_status_str'] ?></td>   
                  <td>
                    <?php 
                    $dateStr=strtotime($row['added_on']);
                    echo date('m-d-Y h:s',$dateStr);
                    ?>
							    </td>	
                </tr>
                <?php
                $i++;
                   }
                }else{ ?>
                  <tr class="no_data_msg">
                    <td colspan="6" class="align_cnt">No Data Found...</td>
                  </tr>
                <?php } ?>
              </tbody>
			      </table>
		      </div>
		    </div>
	    </div>
	  </div>
  </div>

  <?php include('footer.php'); ?>
</body>
</html>