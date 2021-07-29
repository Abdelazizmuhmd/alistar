<?php

require_once("Controller.php");
class userOrderController extends Controller{
 public function getOrders(){

      //$userid = 1;
     if(isset($_REQUEST['userid']))
      $userid = $_REQUEST['userid'];
     $this->model->getorders($userid);
 }
 public function getOrderDetails(){
    if(isset($_REQUEST['orderid']))
     $orderid = $_REQUEST['orderid'];
    $this->model->getorderdetails($orderid);
}
public function updateOrder(){
    if(isset($_REQUEST['orderid']))
     $orderid = $_REQUEST['orderid'];
    if(isset($_REQUEST['status']))
     $status = $_REQUEST['status'];
    $this->model->updateorder($orderid,$status);
}
public function getOrder(){
    if(isset($_REQUEST['orderid']))
     $orderid=$_REQUEST['orderid'];
    $this->model->getordersArray()[0]->readOrder($orderid);

}
    
public function getuser(){
    if(isset($_REQUEST['userid']))
     $userid=$_REQUEST['userid'];
    $this->model->getuser($userid);
    
}
public function delete(){
    if(isset($_REQUEST['orderid']))
     $orderid=$_REQUEST['orderid'];
    $this->model->getordersArray()[0]->delete($orderid);

    
}
public function updatestat(){
    if(isset($_REQUEST['orderid']))
     $orderid=$_REQUEST['orderid'];
    if(isset($_REQUEST['stat']))
     $status=$_REQUEST['stat'];
    $this->model->getordersArray()[0]->updateStat($orderid,$status);

}
    

    
}

?>