<?php
include("header.php");

$all_data_sql = "select * from contact order by id";
$res = mysqli_query($con, $all_data_sql);

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['id']) && $_GET['id'] > 0){
  $type = safe_valueto($_GET['type']);
  $id = safe_valueto($_GET['id']);

  if($type === 'delete'){
    mysqli_query($con, "delete from contact where id='$id'");
    redirect('contact_us.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COntact Us</title>

  </head>
<body>
  
  <div class="card">
    <div class="card-body">
      <h2 class="head-title">Contact Us</h2>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
              <thead>
                <tr class= "table_title">
                <th>Contact Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($res) > 0){ 
                  $i=1;
                  while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
              
                <td><?php echo $i ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['subject'] ?></td>
                  <td><?php echo $row['message'] ?></td>
                  <td>
                    <a href="?id=<?php echo $row['id']; ?>&type=delete"><label class="badge badge-danger">Delete</label></a>
                  </td>
                  
                </tr>
                <?php
                $i++;
                   }
                }else{ ?>
                  <tr class="no_data_msg">
                    <td colspan="4" class="align_cnt">No Data Found...</td>
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