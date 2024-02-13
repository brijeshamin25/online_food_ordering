<?php
include('../database.php');
include('../function.php');

session_start();

if(!isset($_SESSION['admin_nm'])){
  redirect('../login.php');
}
?>
