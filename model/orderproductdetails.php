<?php
require_once("../model/Model.php");
require_once("../model/product.php");
 //test all
class productorderdetails extends model{
    
private $productorderid;
private $productdetailid;
private $productordersize;
private $productorderquantity;
private $product;
    
    
 function __construct($productdetailid,$productordersize,$productorderquantity){
     $this->productdetailid=$productdetailid;
     $this->productordersize=$productordersize;
     $this->productorderquantity=$productorderquantity;
     $this->readproduct($productdetailid);
 }
function readproduct($productdetailid){
      $this->getvalidation();
     $this->validation->validateNumber($productdetailid,1,30);
    $this->connect();
    $sql="select  productid  from productdetails  where id =:productdetailid";
    $this->db->query($sql);
    $this->db->bind(':productdetailid',$productdetailid,PDO::PARAM_INT);
    $this->db->execute();
    $dbobjects=$this->db->getdata();
    

    $productid=$dbobjects[0]->productid;
    $this->productorderid = $productid;
    $this->product=new product($productid,$productdetailid);
}
function getproduct(){
        return $this->product;
}
    
function getproductorderid(){
    return $this->productorderid;
}    
   
function getproductordersize(){
    return $this->productordersize;
}    
function getproductorderquantity(){
    return $this->productorderquantity;
}    
        
    
    
    
    
}

?>