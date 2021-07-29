<?php
require_once("../controller/Controller.php");
class checkOutController extends Controller{
    
function getuser($userid){
        
$this->model->getuser($userid);
        
}
function makeorderclient(){
    if (isset($_REQUEST['firstname']) && isset($_REQUEST['lastname']) && 
        isset($_REQUEST['address']) && isset($_REQUEST['apartmant']) &&
        isset($_REQUEST['city']) && isset($_REQUEST['phone'])) {

    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $address=$_REQUEST['address'];
    $apartmant=$_REQUEST['apartmant'];
    $city=$_REQUEST['city'];
    $phone=$_REQUEST['phone'];

    }
 

$this->model->updateAddress($firstname,$lastname,$address,$apartmant,$city,$phone);
$this->makeorder();
}

function makeorderguest(){
     if (isset($_REQUEST['firstname']) && isset($_REQUEST['lastname']) && 
        isset($_REQUEST['address']) && isset($_REQUEST['apartmant']) &&
        isset($_REQUEST['city']) && isset($_REQUEST['email']) && isset($_REQUEST['phone'])) {

    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $address=$_REQUEST['address'];
    $apartmant=$_REQUEST['apartmant'];
    $email=$_REQUEST['email'];
    $city=$_REQUEST['city'];
    $phone=$_REQUEST['phone'];
    }
    
$this->model->guestsignup($firstname,$lastname,$email,$address,$apartmant,$city,$phone);
$this->makeorder();
}
    
    
    
    
    
function makeorder(){

 if(isset($_REQUEST['producta'])){  
     $products=$_REQUEST['producta'];
foreach($products as $i=>$product){
 $productdetails[]=array("id"=>$product['id'],"size"=>$product['size'],"quantity"=>$product['quantity']);   
    }
    
    if(!isset($_REQUEST['comment'])){
        $_REQUEST['comment']="No Comment";
    }
$this->model->makeOrder($productdetails,$_REQUEST['comment']);
 
 }
    
}}
    ?>