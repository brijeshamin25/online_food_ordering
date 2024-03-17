<?php
include("header.php");

$all_data_sql = "select * from slider order by slider_stack";
$res = mysqli_query($con, $all_data_sql);

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['id']) && $_GET['id'] > 0){
  $type = safe_valueto($_GET['type']);
  $id = safe_valueto($_GET['id']);

  if($type === 'delete'){
    mysqli_query($con, "delete from slider where id='$id'");
    redirect('slider.php');
  }

  if($type === 'onshow' || $type === 'offshow'){
    $slider_status = 1;

    if($type === 'offshow'){
      $slider_status = 0;
    }

    $update_sql = "update slider set slider_status = '$slider_status' where id = '$id'";

    mysqli_query($con, $update_sql);
    redirect('slider.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slider</title>

  </head>
<body>
  
  <div class="card">
    <div class="card-body">
      <h2 class="head-title">Slider</h2>
      <a href="add_slider.php" class="add_menu"> Add Slider</a>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
              <thead>
                <tr class= "slider_title">
                  <th>Slider Id</th>
                  <th>Image</th>
                  <th>Heading</th>
                  <th>Sub Heading</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($res) > 0){ 
                  while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
              
                  <td><?php echo $row['id'] ?></td>
                  <td><img src="<?php echo SITE_SLIDER_IMG_CALL.$row['image'] ?>"/></td>
                  <td><?php echo $row['heading'] ?></td>
                  <td><?php echo $row['sub_heading'] ?></td>
                  <td>
                    <a href="add_slider.php?id=<?php echo $row['id'];?>"><label class="badge badge-success">Edit</label></a>

                    <?php
                      if($row['slider_status'] == 1){
                    ?>
                      <a href="?id=<?php echo $row['id']; ?>&type=offshow"><label class="badge badge-warning">On Show</label></a>
                    <?php 
                      }else{
                    ?>
                      <a href="?id=<?php echo $row['id']; ?>&type=onshow"><label class="badge badge-warning2">Off Show</label></a>
                    <?php 
                      }
                    ?>

                    <a href="?id=<?php echo $row['id']; ?>&type=delete"><label class="badge badge-danger">Delete</label></a>

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