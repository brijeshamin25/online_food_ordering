<?php
function pr($arr){
  echo '<pre>';
  print_r($arr);
}

function prx($arr){
  echo '<pre>';
  print_r($arr);
  die();
}

function redirect($page){
  ?>
  <script>
    window.location.href='<?php echo $page?>';
  </script>
  <?php
  die();
}
?>