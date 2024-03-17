<?php
include("header.php");

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['food_id']) && $_GET['food_id'] > 0){
  $type = safe_valueto($_GET['type']);
  $id = safe_valueto($_GET['food_id']);


  if($type === 'onshow' || $type === 'offshow'){
    $food_status = 1;

    if($type === 'offshow'){
      $food_status = 0;
    }

    $update_sql = "update food set food_status = '$food_status' where food_id = '$id'";

    mysqli_query($con, $update_sql);
    redirect('food.php');
  }
}

// $join_sql = 'select * from food order by food_name desc';

$join_sql = 'select food.*, menu.menu_name 
  from food 
  JOIN menu ON food.menu_id = menu.menu_id
  order by food.food_id asc';

$res=mysqli_query($con, $join_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food</title>

  </head>
<body>
  
  <div class="card">
    <div class="card-body">
      <h2 class="head-title">FOOD</h2>
      <a href="add_food.php" class="add_menu"> Add Food</a>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="menu-list" class="table">
              <thead>
                <tr class="title_width">
                  <th>Food ID</th>
                  <th>Menu</th>
                  <th>Food Name</th>
                  <th>Images</th>
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
                  <td><?php echo $row['menu_name'] ?></td>
                  <td><?php echo $row['food_name'] ?> (<?php echo strtoupper($row['food_type']) ?>)</td>
                  <td><a target="_blank" href="<?php echo SITE_FOOD_IMG_CALL.$row['images'] ?>"> <img class="hover_eff" src="<?php echo SITE_FOOD_IMG_CALL.$row['images'] ?>"></a></td>

                  <td>
                    <a href="add_food.php?food_id=<?php echo $row['food_id'];?>"><label class="badge badge-success">Edit</label></a>

                    <?php
                      if($row['food_status'] == 1){
                    ?>
                      <a href="?food_id=<?php echo $row['food_id']; ?>&type=offshow"><label class="badge badge-warning">On Show</label></a>
                    <?php 
                      }else{
                    ?>
                      <a href="?food_id=<?php echo $row['food_id']; ?>&type=onshow"><label class="badge badge-warning2">Off Show</label></a>
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
                    <td colspan="5" class="align_cnt">No Data Found...</td>
                  </tr>
                <?php
                }
                ?>
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