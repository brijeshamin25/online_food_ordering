<?php
include("header.php");

$all_data_sql = "select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.order_status_id order by order_master.order_master_id desc";
$res = mysqli_query($con, $all_data_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>

  </head>
<body>
  
  <div class="card">
    <div class="card-body">
      <h2 class="head-title">Order</h2>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
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