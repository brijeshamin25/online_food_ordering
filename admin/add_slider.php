<?php
include("header.php");

$id = "";
$image = "";
$heading = "";
$sub_heading = "";
$link = "";
$link_text = "";
$slider_stack = "";
$img_validation = "required";
$error_msg = "";

if(isset($_GET['id']) && $_GET['id'] > 0){
  $id = safe_valueto($_GET['id']);
  $id_select_sql = "select * from slider where id = '$id'";
  $res = mysqli_fetch_assoc(mysqli_query($con, $id_select_sql));

  $image = $res['image'];
  $heading = $res['heading'];
  $sub_heading = $res['sub_heading'];
  $link = $res['link'];
  $link_text = $res['link_text'];
  $slider_stack = $res['slider_stack'];
  $img_validation = '';
}

if(isset($_POST["submit"])){
  $heading = safe_valueto($_POST["heading"]);
  $sub_heading = safe_valueto($_POST["sub_heading"]);
  $link = safe_valueto($_POST["link"]);
  $link_text = safe_valueto($_POST["link_text"]);
  $slider_stack = safe_valueto($_POST["slider_stack"]);


  if($id === ""){
    $img_type = $_FILES['image']['type'];
    if( $img_type != 'image/jpeg' && $img_type != 'image/png' && $img_type != 'image/JPG'){
      $error[] = 'Please use JPEG, PNG or JPG  image file type...';
    }else{
      $image = rand(11111,99999).'_'.$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],SERVER_SLIDER_IMG_UPLOAD.$image);
      $insert_sql = "insert into slider(heading,sub_heading,link,link_text,slider_stack,slider_status,image) values('$heading','$sub_heading','$link','$link_text','$slider_stack',1,'$image')";
      $res = mysqli_query($con,$insert_sql);
      redirect("slider.php");
    }
  } else{
    if($img_type = $_FILES['image']['type'] == ''){
      $update_sql = "update slider set heading = '$heading', sub_heading = '$sub_heading', link = '$link',link_text = '$link_text',slider_stack = '$slider_stack', image = '$image' where id = '$id'";
      $res = mysqli_query($con, $update_sql);
      redirect("slider.php");
    }else{
      $img_type = $_FILES['image']['type'];

      if( $img_type != 'image/jpeg' && $img_type != 'image/png' && $img_type != 'image/JPG'){
        $error[] = 'Please use JPEG, PNG or JPG  image file type...';
        redirect("slider.php");
      }else{
        $image = rand(11111,99999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],SERVER_SLIDER_IMG_UPLOAD.$image);

        $update_sql = "update slider set heading = '$heading', sub_heading = '$sub_heading', link = '$link',link_text = '$link_text',slider_stack = '$slider_stack', image = '$image' where id = '$id'";
        $res = mysqli_query($con, $update_sql);
        redirect("slider.php");
      }
    }   
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Slider</title>

  </head>
<body>
  
  <div class="row">
    <h1 class="head-title ml20">Add Slider</h1>
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputName1">Image</label>
                <input type="file" class="form-control" placeholder="Image" name="image" <?php echo $img_validation ?>>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Heading</label>
                <input type="text" class="form-control" placeholder="Heading" name="heading" value="<?php echo $heading ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Sub Heading</label>
                <input type="text" class="form-control" placeholder="Sub Heading" name="sub_heading" value="<?php echo $sub_heading ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Link</label>
                <input type="text" class="form-control" placeholder="Link" name="link" value="<?php echo $link ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Link Text</label>
                <input type="text" class="form-control" placeholder="Link Text" name="link_text" value="<?php echo $link_text ?>" required>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail3">Slider Stack</label>
                <input type="text" class="form-control" placeholder="Slider Stack" name="slider_stack" value="<?php echo $slider_stack ?>" required>
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

            </form>
          </div>
        </div>
      </div>     
	</div>

<?php include('footer.php'); ?>
</body>
</html>