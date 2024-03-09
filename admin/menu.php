<?php
include("header.php");

$all_data_sql = "select * from menu order by menu_stack";
$res = mysqli_query($con, $all_data_sql);

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['menu_id']) && $_GET['menu_id'] > 0){
  $type = safe_valueto($_GET['type']);
  $id = safe_valueto($_GET['menu_id']);

  if($type === 'delete'){
    mysqli_query($con, "delete from menu where menu_id='$id'");
    redirect('menu.php');
  }

  if($type === 'onshow' || $type === 'offshow'){
    $menu_status = 1;

    if($type === 'offshow'){
      $menu_status = 0;
    }

    $update_sql = "update menu set menu_status = '$menu_status' where menu_id = '$id'";

    mysqli_query($con, $update_sql);
    redirect('menu.php');
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
      <h2 class="head-title">MENU</h2>
      <a href="add_menu.php" class="add_menu"> Add Menu</a>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
              <thead>
                <tr class= "table_title">
                  <th>Menu Id</th>
                  <th>Name</th>
                  <th>Menu Stack</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($res) > 0){ 
                  while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
              
                  <td><?php echo $row['menu_id'] ?></td>
                  <td><?php echo $row['menu_name'] ?></td>
                  <td><?php echo $row['menu_stack'] ?></td>
                  <td>
                    <a href="add_menu.php?menu_id=<?php echo $row['menu_id'];?>"><label class="badge badge-success">Edit</label></a>

                    <?php
                      if($row['menu_status'] == 1){
                    ?>
                      <a href="?menu_id=<?php echo $row['menu_id']; ?>&type=offshow"><label class="badge badge-warning">On Show</label></a>
                    <?php 
                      }else{
                    ?>
                      <a href="?menu_id=<?php echo $row['menu_id']; ?>&type=onshow"><label class="badge badge-warning2">Off Show</label></a>
                    <?php 
                      }
                    ?>

                    <a href="?menu_id=<?php echo $row['menu_id']; ?>&type=delete"><label class="badge badge-danger">Delete</label></a>

                  </td>
                  
                </tr>
                <?php
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