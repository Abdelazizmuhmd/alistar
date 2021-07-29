<?php
require_once("../model/user.php");
if(!isset($_REQUEST['mail'])){
 header("location:../public/signup.php");
}

$model= new user();
  $mail = $_REQUEST['mail'];



if($model->checkEmail($mail)>0)
{
    
    echo $model->checkEmail($mail);
    
    
}





  

 

    








?>