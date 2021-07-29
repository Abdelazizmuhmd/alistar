<?php 
require_once("../model/Model.php");
class report extends model{
  private  $cost;
   private $profit;
    
    function __construct(){
        $this->cost=0;
        $this->profit=0;
        $this->getreport();
    }
    
    function getcost(){
        return $this->cost;
    }
    function getprofit(){
            return    $this->profit;

    }
    
    
  function getreport(){
    $this->connect();
     $sql="select product.cost,product.profit from orderdetails join productdetails on orderdetails.productdetailid = productdetails.id join product on productdetails.productid =product.id" ;
     $this->db->query($sql);
     $this->db->execute();
     if ($this->db->numRows() > 0){
     $row = $this->db->getdata();
      foreach($row as $value){
          $this->cost +=(int)$value->cost;
          $this->profit +=(int)$value->profit;

      }
         
         
  }
    
}}


?>