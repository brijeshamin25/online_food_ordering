<?php
include('database.php');
include('function.php');

session_start();
session_unset();
session_destroy();

redirect('login.php');
//header('location:login.php');
?>