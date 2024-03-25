<?php 
include('database.php');
include('function.php');
include('default.php');
include('init.php');

$publishablekey = "pk_test_51OxbkXCeUvhNqjKasgq22pz13qW7GhAa0m5D5U67RP6yjNXUbFjqVcSqLtoSkHigKAwmqU5s6yR5RlJggZ58jOLJ00w7pLWbeh";

$secretkey = "sk_test_51OxbkXCeUvhNqjKaHx9OpejOVGtayCzVXyO31TfCVJvrNRTzVCqptbmrhb9tcFF7IgQLJkHBPnvE08DrAwtHngV600Pym8el9z";

\Stripe\Stripe::setApiKey($secretkey);
?>