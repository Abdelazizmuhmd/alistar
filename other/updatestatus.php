<?php
require_once("../model/user.php");
require_once("../controller/userOrder.php");
include_once("../other/sessioncheck.php");

$model = new user();
$controller = new userOrderController($model); 
$controller->updatestat();

 
echo 1;



?>