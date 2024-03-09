<?php
include("header.php");

$id = "";
$menu_nm = "";
$menu_stk_num = "";
$error_msg = "";

if(isset($_GET['menu_id']) && $_GET['menu_id'] > 0){
  $id = safe_valueto($_GET['menu_id']);
  $id_select_sql = "select * from menu where menu_id = '$id'";
  $res = mysqli_fetch_assoc(mysqli_query($con, $id_select_sql));

  $menu_nm = $res['menu_name'];
  $menu_stk_num = $res['menu_stack'];
}

if(isset($_POST["submit"])){
  $menu_nm = safe_valueto($_POST["menu_name"]);
  $menu_stk_num = safe_valueto($_POST["menu_stack_num"]);

  if($id === ''){
    $select_sql = "select * from menu where menu_name = '$menu_nm'";
  }else{
    $select_sql = "select * from menu where menu_name = '$menu_nm' and menu_id != '$id'";
  } 
  
  if(mysqli_num_rows(mysqli_query($con, $select_sql)) > 0){
    $error[] = "Menu Name Already Exists...";
  }else{
    if($id === ""){
      $insert_sql = "insert into menu(menu_name,menu_stack,menu_status) values('$menu_nm','$menu_stk_num',1)";

      $res = mysqli_query($con,$insert_sql);
    } else{
      $update_sql = "update menu set menu_name = '$menu_nm', menu_stack = '$menu_stk_num' where menu_id = '$id'";

      $res = mysqli_query($con, $update_sql);
    }  
    redirect("menu.php");
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Menu</title>

  </head>
<body>
  
  <div class="row">
    <h1 class="head-title ml20">Add Menu</h1>
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" method="post">
              <div class="form-group">
                <label for="exampleInputName1">Menu Name</label>
                <input type="text" class="form-control" placeholder="Menu Name" name="menu_name" value="<?php echo $menu_nm ?>" required>
              </div>
              
              <div class="error_div">
                <?php 
                  if(isset($error)){
                    foreach($error as $error){
                      echo'<span class="err_msg">'.$error.'</span>';
                    }
                  }
                ?>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail3">Menu Stack Number</label>
                <input type="text" class="form-control" placeholder="Menu Stack Number" name="menu_stack_num" value="<?php echo $menu_stk_num ?>" required>
              </div>

              <button type="submit" class="btn btn_rds btn-primary mr-2" name="submit"><span>Submit </span></button>

            </form>
          </div>
        </div>
      </div>     
	</div>

<?php include('footer.php'); ?>
</body>
</html>