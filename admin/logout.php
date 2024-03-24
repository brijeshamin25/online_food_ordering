<?php
include('database.php');
include('function.php');

session_start();

unset($_SESSION['admin_nm']);

session_unset();
session_destroy();

header('location:../login_signup.php');
?>