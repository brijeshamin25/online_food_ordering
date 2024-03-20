<?php
include('database.php');
include('function.php');

session_start();

session_unset();
session_destroy();

header('location:../login_signup.php');
?>