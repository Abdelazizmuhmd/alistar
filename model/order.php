<?php

require_once("../model/Model.php");
require_once("../model/product.php");
require_once("../model/orderproductdetails.php");
require_once("../model/user.php");

 //test
class order extends Model{
  private $id;
  private $userid;
  private $comment;
  private $status;
  private $createdtime;
  private $productorderdetails;
  private $user;
    
function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }
function __construct1($id) {
      $this->id = $id;
      $this->readOrder($id);
  }
function __construct2($id,$flag) {
       $this->id = $id;
       $this->readOrder($id);
       $this->getUserDetails();
  }
function __construct3($userid,$productsdetails,$comment) {
    $this->makeorder($userid,$productsdetails,$comment);
  }
function getuser(){
    return $this->user;
}

    function setUserid($userid){
      $this->userid = $userid;
    }

    function getUserid(){
      return $this->userid;
    }


    function setComment($comment){
      $this->comment = $comment;
    }

    function getComment(){
      return $this->comment;
    }



    function setStatus($status){
      $this->status = $status;
    }

    function getStatus(){
      return $this->status;
    }
    function getId(){
      return $this->id;
    }




    function setCreatedtime($createdtime){
      $this->createdtime = $createdtime;
    }

    function getCreatedtime(){
      return $this->createdtime;
    }




    function setArray($array){
      $this->$products = $array;
    }

    function getProducts(){
      return $this->productorderdetails;
    }

function getUserDetails(){
    $this->user = new user($this->userid);
   
}
   
   

   

function getorderdetails($orderid){
     $this->getvalidation();
     $this->validation->validateNumber($orderid,1,50);
    
    $this->connect();
    $sql="select id,productdetailid,size,quantity from orderdetails  where orderid =:orderid";
    $this->db->query($sql);
    $this->db->bind(':orderid',$orderid,PDO::PARAM_INT);
    $this->db->execute();
    $dbobjects=$this->db->getdata();
    foreach($dbobjects as $dbobject){
    $productdetailid=$dbobject->productdetailid;
    $productordersize=$dbobject->size;
    $productorderquantity= $dbobject->quantity;
    $this->productorderdetails[]=new productorderdetails($productdetailid,$productordersize,$productorderquantity);
   
    }
    
    
    
    
}


function makeOrder ($userid,$productsdetails,$comment){
        $comment=trim($comment);
        $userid=trim($userid);

        $this->getvalidation();
        if(strlen($comment)!=0){
        $this->validation->validateMixedString($comment,1,80);
        }else{
            $comment="no comment";
        }
    
    
        $this->connect();
        $sqlOrder = "INSERT INTO `order` (userid,comment,status) VALUES (:userid,:comment,:status)";
        $this->db->query($sqlOrder);
        $this->db->bind(':userid',$userid,PDO::PARAM_INT);
        $this->db->bind(':comment',$comment,PDO::PARAM_STR);
        $this->db->bind(':status',"Pending",PDO::PARAM_STR);
        $this->db->execute();
        $orderid=$this->db->lastInsertedId();
          $length=count($productsdetails);
        for ($i = 0; $i < $length; $i++) {
            // assiarray
         $this->connect();
            
         $productdetailid=trim($productsdetails[$i]['id']);
         $productdetailsize=trim($productsdetails[$i]['size']);
         $productdetailquantity=trim($productsdetails[$i]['quantity']);
         
        $this->validation->validateNumber($productdetailid,1,50);
        $this->validation->validateStringEAS($productdetailsize,1,30);
        $this->validation->validateNumber($productdetailquantity,1,30);

        $this->checkQuantity($productdetailid,$productdetailsize,$productdetailquantity);
        $sqlOrderDetails = "INSERT INTO orderdetails (orderid,productdetailid,size,quantity) VALUES (:orderid ,:productdetailid,:size,:quantity)";
            
          $this->validation->validateNumber($orderid,1,50);
   
           $this->db->query($sqlOrderDetails);
           $this->db->bind(':orderid',$orderid,PDO::PARAM_INT);
           $this->db->bind(':productdetailid',$productdetailid,PDO::PARAM_INT);
           $this->db->bind(':size',$productdetailsize,PDO::PARAM_STR);
           $this->db->bind(':quantity',$productdetailquantity,PDO::PARAM_INT);
           $this->db->execute();
          

      }}
function checkQuantity($id,$size,$quantity){

    if($size=="Small"){
    $sql="select id from productdetails where id =:id and s <:size";
    }
    else if($size=="Medium"){
        $sql="select id from productdetails where id =:id and m  <:size";
    }
      else if($size=="Large"){
        $sql="select id from productdetails where id =:id and l  <:size";
    }
      else if($size=="XL"){
        $sql="select id from productdetails where id =:id and xl  <:size";
    }
  else if($size=="XXL"){
        $sql="select id from productdetails where id =:id and xxl <:size";
    }
    else if($size=="XXXL"){
        $sql="select id from productdetails where id =:id and xxxl  <:size";
    }else{
        header("location: ../public/aaa.html");
        die();
    }
  $this->connect();
  $this->db->query($sql);
  $this->db->bind(':id',$id,PDO::PARAM_INT);
  $this->db->bind(':size',$quantity,PDO::PARAM_INT);
  $this->db->execute();
  
   if ($this->db->numRows() > 0){
   if (isset($_COOKIE['cook'])) {
    unset($_COOKIE['cook']); 
    setcookie('cook', null, -1, '/'); 
     } 
      header("location: ../public/soldout.php");
      die();
      
      }
    
        
        
    
}
      function readOrder($id){
     $this->getvalidation();
     $this->validation->validateNumber($id,1,50);
          
          $this->connect();
          $sql = "select userid,id,comment,status,createdtime from `order` where id = :id and isdeleted = 0    ";
          $this->db->query($sql);
          $this->db->bind(':id',$id,PDO::PARAM_INT);
          $this->db->execute();
          $row = $this->db->getdata();
          if($this->db->numRows()){
          $this->id=$row[0]->id;
          $this->comment = $row[0]->comment;
          $this->status = $row[0]->status;
          $this->createdtime = $row[0]->createdtime;
          $this->userid = $row[0]->userid;
          }
      }
    
    /*function delete ($orderid){
         $this->getvalidation();
     $this->validation->validateNumber($orderid,1,1000000);
        $this->connect();
        $sql = "update `order` set isdeleted=1 where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$orderid,PDO::PARAM_INT);
        $this->db->execute();
     }*/
       function delete ($orderid){
         $this->getvalidation();
     $this->validation->validateNumber($orderid,1,50);
        $this->connect();
        if($_SESSION['usertype'] == 'admin'){
        $sql = "update `order` set isdeleted=1 where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$orderid,PDO::PARAM_INT);
        $this->db->execute();
        }
        else
        {
        $sql = "select userid from `order` where id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$orderid,PDO::PARAM_INT);
        $this->db->execute();
         if($this->db->getdata()[0]->userid == $_SESSION['id'] )
         {
          $sql = "update `order` set isdeleted=1 where id=:id";
          $this->db->query($sql);
          $this->db->bind(':id',$orderid,PDO::PARAM_INT);
          $this->db->execute();
         }
         else
         {
          header("location: ../public/error.html");
          die();
         }


        }
     }
     function updateStat($orderid,$status){
         $orderid=trim($orderid);
         $status=trim($status);
     $this->getvalidation();
     $this->validation->validateNumber($orderid,1,50);
     $this->validation->validateString($status,1,100);
         
         
      $this->connect();
      $sql = "update `order` set status=:status where id=:id";
      $this->db->query($sql);
      $this->db->bind(':id',$orderid,PDO::PARAM_INT);
      $this->db->bind(':status',$status,PDO::PARAM_STR);
      $this->db->execute();
       
     }

 
    
    
    
}
    
    
    
    

?>