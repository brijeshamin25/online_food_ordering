<?php
include("header.php");

$all_data_sql = "select * from reg_login where user_type = 'customer' order by user_id asc";
$res = mysqli_query($con, $all_data_sql);

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['user_id']) && $_GET['user_id'] > 0){
  $type = safe_valueto($_GET['type']);
  $id = safe_valueto($_GET['user_id']);


  if($type === 'onshow' || $type === 'offshow'){
    $user_status = 1;

    if($type === 'offshow'){
      $user_status = 0;
    }

    $update_sql = "update reg_login set user_status = '$user_status' where user_id = '$id'";

    mysqli_query($con, $update_sql);
    redirect('customer.php');
  }
}

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
      <h2 class="head-title">Customers</h2>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
              <thead>
                <tr class= "user_table_title">
                  <th>Customer ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($res) > 0){ 
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row['fname'] ?></td>
                  <td><?php echo $row['lname'] ?></td>	
                  <td><?php echo $row['phone_number'] ?></td>	
                  <td><?php echo $row['email'] ?></td>
                  <td>

                    <?php
                      if($row['user_status'] == 1){
                    ?>
                      <a href="?user_id=<?php echo $row['user_id']; ?>&type=offshow"><label class="badge badge-warning">Active</label></a>
                    <?php 
                      }else{
                    ?>
                      <a href="?user_id=<?php echo $row['user_id']; ?>&type=onshow"><label class="badge badge-warning2">Deactive</label></a>
                    <?php 
                      }
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