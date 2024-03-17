<?php
include("header.php");

$id = "";
$menu_id = "";
$food_name = "";
$food_type = "";
$description = "";
$images = "";
$error_msg = "";
$img_validation = "required";

if(isset($_GET['food_id']) && $_GET['food_id'] > 0){
  $id = safe_valueto($_GET['food_id']);
  $id_select_sql = "select * from food where food_id = '$id'";
  $res = mysqli_fetch_assoc(mysqli_query($con, $id_select_sql));

  $menu_id = $res['menu_id'];
  $food_name = $res['food_name'];
  $food_type = $res['food_type'];
  $description = $res['description'];
  $images = $res['images'];
  $img_validation = '';
}

if(isset($_GET['food_item_id']) && $_GET['food_item_id']>0){
  $food_detail_id = safe_valueto($_GET['food_item_id']);
  $food_id = safe_valueto($_GET['food_id']);
  mysqli_query($con, "delete from food_item where food_item_id='$food_detail_id'");
  redirect('add_food.php?food_id='.$food_id);
}

if(isset($_POST["submit"])){
  $menu_id = safe_valueto($_POST["menu_id"]);
  $food_name = safe_valueto($_POST["food_name"]);
  $food_type = safe_valueto($_POST["food_type"]);
  $description = safe_valueto($_POST["description"]);

  if($id === ''){
    $select_sql = "select * from food where food_name = '$food_name'";
  }else{
    $select_sql = "select * from food where food_name = '$food_name' and food_id != '$id'";
  } 
  
  if(mysqli_num_rows(mysqli_query($con, $select_sql)) > 0){
    $error[] = "Food Name Already Exists...";
  }else{
    $img_type = $_FILES['images']['type'];
    
    if($id === ""){
      if( $img_type != 'image/jpeg' && $img_type != 'image/png' && $img_type != 'image/JPG'){
        $error[] = 'Please use JPEG, PNG or JPG  image file type...';
      }else{
        // $images = $_FILES['images']['name'];
        $images = rand(11111,99999).'_'.$_FILES['images']['name'];
        move_uploaded_file($_FILES['images']['tmp_name'],SERVER_FOOD_IMG_UPLOAD.$images);

        $insert_sql = "insert into food(menu_id,food_name,food_type,description,images,food_status) values('$menu_id','$food_name','$food_type','$description', '$images', 1)";

        $res = mysqli_query($con,$insert_sql);

        $addFoodId = mysqli_insert_id($con);//Last recorded Id
        $attribArray = $_POST['food_attribute'];
        $priceArray = $_POST['price'];

        foreach($attribArray as $key => $value){
          $attr = $value;
          $prs = $priceArray[$key];
          $insertSql = "insert into food_item(food_id,food_attribute,price,food_status) values('$addFoodId','$attr','$prs',1)";
          $res = mysqli_query($con,$insertSql);
        }

        redirect("food.php");
      }
      
    } else{
      
      $img_constrain = '';

      if($_FILES['images']['name'] != ''){
        if( $img_type != 'image/jpeg' && $img_type != 'image/jpg' && $img_type != 'image/png'){
          $error[] = 'Please use JPEG, PNG or JPG image file type...';
        }else{
          // $images = $_FILES['images']['name'];
          $images = rand(11111,99999).'_'.$_FILES['images']['name'];
          move_uploaded_file($_FILES['images']['tmp_name'],SERVER_FOOD_IMG_UPLOAD.$images);
          $img_constrain = ", images= '$images'";
        }
      }
      
      if($error == ''){
        $update_sql = "update food set menu_id = '$menu_id', food_name = '$food_name', food_type = '$food_type', description = '$description' $img_constrain where food_id = '$id'";

        $res = mysqli_query($con, $update_sql);

        $attribArray = $_POST['food_attribute'];
        $priceArray = $_POST['price'];
        $foodDetailIdArry = $_POST['food_detail_id'];

        foreach($attribArray as $key => $value){
          $attr = $value;
          $prs = $priceArray[$key];

          if(isset($foodDetailIdArry[$key])){
            $id_new = $foodDetailIdArry[$key]; 
            $updateSql = "update food_item set food_attribute='$attr', price='$prs' where food_item_id = '$id_new'";
            $res = mysqli_query($con,$updateSql);
          }else{
            $insertSql = "insert into food_item(food_id,food_attribute,price,food_status) values('$id','$attr','$prs',1)";
            $res = mysqli_query($con,$insertSql);
          }
        }
        redirect("food.php");
      }
    }  
  } 
}

$option_menu_sql = "select * from menu where menu_status = '1' order by menu_name asc";
$menu_res = mysqli_query($con, $option_menu_sql);

$food_type_arr = array("Veg","Non-Veg");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Food</title>

  </head>
<body>
  
  <div class="row">
    <h1 class="head-title ml20">Add Food</h1>
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputName1">Menu Name: </label>
                
                <select name="menu_id" class="form-control" required>
                  <option value="">Select Menu Name</option>
                  <?php 
                    while($row = mysqli_fetch_assoc($menu_res)){
                      if($row["menu_id"] == $menu_id){
                        echo "<option value='".$row['menu_id']."' selected>" .$row['menu_name']. "</option>";
                      }else{
                        echo "<option value='".$row['menu_id']."'>" .$row['menu_name']. "</option>";
                      }
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail3">Food Name</label>
                <input type="text" class="form-control" placeholder="Food Name" name="food_name" value="<?php echo $food_name ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Food Type: </label>
                
                <select name="food_type" class="form-control" required>
                  <option value="">Select Food Type</option>
                  <?php
                    foreach ($food_type_arr as $list) {
                      if($list === '$food_type'){
                        echo "<option value='$list' selected>".strtoupper($list)."</option>";
                      }else{
                        echo "<option value='$list'>".strtoupper($list)."</option>";
                      }
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail3">Description</label>
                <input type="text" class="form-control" placeholder="Food Description" name="description" value="<?php echo $description ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail3">Food Image</label>
                <input type="file" class="form-control" placeholder="Food Image" name="images" <?php echo $img_validation?>>
              </div>
              
              <div class="form-group" id="attribute_row">
                <label for="exampleInputEmail3">Food Attributes & Price</label>

              <?php if($id === 0) {?>
                <div class="row">
                  <div class="col-5">
                    <label for="exampleInputEmail3">Food Attribute</label>
                    <input type="text" class="form-control" placeholder="Food Attribute" name="food_attribute[]" required>
                  </div>

                  <div class="col-5">
                    <label for="exampleInputEmail3">Price</label>
                    <input type="text" class="form-control" placeholder="Food Attribute Price" name="price[]" required>
                  </div>
                </div>
              <?php } else {
                $attri_selectSql = "select * from food_item where food_id = '$id'";
                $food_item_res = mysqli_query($con, $attri_selectSql);

                $j = 1;

                while($food_item_row = mysqli_fetch_assoc($food_item_res)){
                ?>
                <div class="row">
                  <div class="col-5">
                    <!-- <label for="exampleInputEmail3">Food Attribute</label> -->

                    <input type="hidden" name="food_detail_id[]" value="<?php echo $food_item_row['food_item_id']?>">

                    <input type="text" class="form-control" placeholder="Food Attribute" name="food_attribute[]" required value="<?php echo $food_item_row['food_attribute']?>">
                  </div>

                  <div class="col-5">
                    <!-- <label for="exampleInputEmail3">Price</label> -->
                    <input type="text" class="form-control" placeholder="Food Attribute Price" name="price[]" required value="<?php echo $food_item_row['price']?>">
                  </div>

                  <?php if($j != 1){?>
                    <div class="col-2"><button type="button" class="btn btn_rmv btn-primary" onclick="remove_last('<?php echo $food_item_row['food_item_id']?>')"><span>Remove </span></button></div>
                  <?php }?>
                </div>  
              <?php
              $j++;
              } }?>
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

              <button type="submit" class="btn btn_rds btn-primary mr-2" name="submit"><span>Submit </span></button>
              
              <button type="button" class="btn btn_rds_2 btn-primary mr-2" onclick="add_attr()"><span>Add Atrribute </span></button>
            </form>
          </div>
        </div>
      </div>     
	</div>
  <input type="hidden" id='add_more' value='1'>
  <script>
    function add_attr(){
      var add_more = jQuery('#add_more').val();
      add_more++;
      jQuery('#add_more').val(add_more);

      var html = '<div class="row" id="rmv_btn'+add_more+'"><div class="col-5"><input type="text" class="form-control" placeholder="Food Attribute" name="food_attribute[]" required></div><div class="col-5"><input type="text" class="form-control" placeholder="Food Attribute Price" name="price[]" required></div><div class="col-2"><button type="button" class="btn btn_rmv btn-primary" onclick=remove_btn("'+add_more+'")><span>Remove </span></button></div>';
      jQuery('#attribute_row').append(html);
    }

    function remove_btn(id){
      jQuery('#rmv_btn'+id).remove();
    }

    function remove_last(id){
      var result = confirm('Are you Sure?');
      if(result === true){
        var cur_loc =window.location.href;
        window.location.href=cur_loc+"&food_item_id="+id;
      }
    }
  </script>

<?php include('footer.php'); ?>
</body>
</html>