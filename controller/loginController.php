<?php


require_once("Controller.php");

class loginController extends Controller{

 public function login(){
     if(isset($_REQUEST['email']))
      $email = $_REQUEST['email'];
    if(isset($_REQUEST['password']))
      $password = $_REQUEST['password'];
     $this->model->login($email,$password);

 }
  public function forgetPassword(){
  if(isset($_REQUEST['email']))
  $email = $_REQUEST['email'];
  $this->model->forgetPassword($email);

 }







}

?>