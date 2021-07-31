<?php

require_once("../model/Model.php");
require_once("../model/productDetails.php");
class product extends model{
protected $id;
protected $name;
protected $code;
protected $cost;
protected $oldprice;
protected $profit;
protected $description;
protected $weight;
protected $productDetails;

    
function getName(){
    return $this->name;
}
function getId(){
    return $this->id;
}
function getCode(){
    return $this->code;
}
function getCost(){
    return $this->cost;
}

function getoldpricce(){
    return $this->oldprice;
}

function getProfit(){
    return $this->profit;
}
function getDescription(){
    return $this->description;
}
function getWeight(){
    return $this->weight;
} 
function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }
function __construct0(){
$this->productDetails[]=new productDetails();
}    
function __construct2($productid,$productdetailId){
    $this->readoneProductDetail($productid,$productdetailId);

}        
function readoneProductDetail($productid,$productdetailId){
     $this->getvalidation();
     $this->validation->validateNumber($productid,1,30);
     $this->validation->validateNumber($productdetailId,1,30);

    
     $this->connect();

     $sql="select * from product where id = :productid " ;
     $this->db->query($sql);
     $this->db->bind(':productid',$productid,PDO::PARAM_INT);
     $this->db->execute();
     if ($this->db->numRows() > 0){
     $product = $this->db->getdata();
     $this->id =$product[0]->id;
     $this->name = $product[0]->name;
     $this->code = $product[0]->code;
     $this->cost = (int)$product[0]->cost;
     $this->oldprice = (int)$product[0]->oldprice;
     $this->profit =(int)$product[0]->profit;
     $this->description =$product[0]->description;
     $this->weight =$product[0]->weight;}
    $sql="select * from productdetails where id = :productdetailid  ";
    $this->db->query($sql);
    $this->db->bind(':productdetailid',$productdetailId,PDO::PARAM_INT);
    $this->db->execute();
    if ($this->db->numRows() > 0){
    $productDetailsObject = $this->db->getdata();
    foreach ($productDetailsObject as $value){
    $productdetails = new productdetails($value->id,$value->productid,$value->color,$value->s,$value->m,$value->l,$value->xl,$value->xxl,$value->xxxl,$value->sold,$value->imageUrl);
    $this->productDetails[] = $productdetails;
    }     
         
    }
    
    
    
    
}
    
    
function __construct1($productId){
 $this->readProduct($productId);
}    
    
  
    
function getProductDetails(){
    return $this->productDetails;
}

    
 function insertProduct($name,$code,$cost,$oldprice,$profit,$description,$weight,$productdetail,$subcategoryid){
     
         $name=trim($name);
         $code=trim($code);
         $cost=trim($cost);
         $oldprice=trim($oldprice);
         $profit=trim($profit);
         $description=trim($description);
         $weight=trim($weight);
         $subcategoryid=trim($subcategoryid);

         if($oldprice == ""){
            $oldprice = "0";
         }

         $this->getvalidation();
     
         $this->validation->validateMixedString($name,1,30);
     
         $this->validation->validateMixedString($code,1,30);
     
         $this->validation->validateNumber($cost,1,30);
         $this->validation->validateNumber($oldprice,1,30);
     
         $this->validation->validateNumber($profit,1,30);
     
         $this->validation->validateMixedString($description,1,1000);
     
         $this->validation->validateMixedString($weight,1,30);
     
         $this->validation->validateNumber($subcategoryid,1,30);
     

      $this->connect();
      $sql = "INSERT into product(name,code,cost,oldprice,profit,description,weight) values(:name,:code,:cost,:oldprice,:profit,:description,:weight)";
      $this->db->query($sql);
      $this->db->bind(':name',$name,PDO::PARAM_STR);
      $this->db->bind(':code',$code,PDO::PARAM_STR);
      $this->db->bind(':cost',$cost,PDO::PARAM_INT);
      $this->db->bind(':oldprice',$oldprice,PDO::PARAM_INT);
      $this->db->bind(':profit',$profit,PDO::PARAM_INT);
      $this->db->bind(':description',$description,PDO::PARAM_STR);
      $this->db->bind(':weight',$weight,PDO::PARAM_INT);
      $this->db->execute();
      $productid=$this->db->lastInsertedId();
     
     
          
        $this->productDetails[0]->insert($productid,$productdetail['color'],$productdetail['s'],$productdetail['m'],$productdetail['l'],$productdetail['xl'],$productdetail['xxl'],$productdetail['xxxl'],$productdetail['img']);  
      
     
      $sql = "INSERT into subcategorydetails(subcategoryid,productid) values(:subcategoryid,:productid)";
      $this->db->query($sql);
      $this->db->bind(':subcategoryid',$subcategoryid,PDO::PARAM_INT);
      $this->db->bind(':productid',$productid,PDO::PARAM_INT);
      $this->db->execute();
     return $productid;
    
}    
    
   
    
    
     function update($productid,$productdetailid,$name,$code,$cost,$oldprice,$profit,$description,$weight,$color,$s,$m,$l,$xl,$xxl,$xxxl,$imageurls){
         $productid=trim($productid);
         $productdetailid=trim($productdetailid);
         $name=trim($name);
         $code=trim($code);
         $profit=trim($profit);
         $description=trim($description);
         $weight=trim($weight);
         $color=trim($color);
         $s=trim($s);
         $m=trim($m);
         $l=trim($l);
         $xl=trim($xl);
         $xxl=trim($xxl);
         $xxxl=trim($xxxl);

         $this->getvalidation();
         
        $this->validation->validateMixedString($name,1,30);
        $this->validation->validateMixedString($code,1,30);
        $this->validation->validateNumber($cost,1,30);
        $this->validation->validateNumber($oldprice,1,30);
     
        $this->validation->validateNumber($profit,1,30);
     
        $this->validation->validateMixedString($description,1,1000);
     
        $this->validation->validateNumber($weight,1,30);
     
        $this->validation->validateNumber($productid,1,30);
     

      $this->connect();
      $sql = "update product  set name= :name ,code=:code ,cost=:cost,oldprice=:oldprice ,profit=:profit,description=:description,weight=:weight where id =:id";
         
      $this->db->query($sql);

      $this->db->bind(':name',$name,PDO::PARAM_STR);

      $this->db->bind(':code',$code,PDO::PARAM_STR);

         
      $this->db->bind(':cost',$cost,PDO::PARAM_INT);
      $this->db->bind(':oldprice',$oldprice,PDO::PARAM_INT);
      $this->db->bind(':profit',$profit,PDO::PARAM_INT);
      $this->db->bind(':description',$description,PDO::PARAM_STR);
      $this->db->bind(':weight',$weight,PDO::PARAM_INT);
      $this->db->bind(':id',$productid,PDO::PARAM_INT);
      $this->db->execute();

     $this->productDetails[0]->update($productdetailid,$color,$s,$m,$l,$xl,$xxl,$xxxl,$imageurls);

      echo $productid;
        
        
     
         
    
}   
    
    
function readProduct($productid){
     $this->getvalidation();
     $this->validation->validateNumber($productid,1,30);
    $this->connect();
     $sql="select * from product where id = :id and isdeleted = 0" ;
     $this->db->query($sql);
     $this->db->bind(':id',$productid,PDO::PARAM_INT);
     $this->db->execute();
     if ($this->db->numRows() > 0){
     $product = $this->db->getdata();
     $this->id =$product[0]->id;
     $this->name = $product[0]->name;
     $this->code = $product[0]->code;
     $this->cost = (int)$product[0]->cost;
     $this->oldprice = (int)$product[0]->oldprice;
     $this->profit =(int)$product[0]->profit;
     $this->description =$product[0]->description;
     $this->weight =$product[0]->weight;
     }

    $sql="select * from productdetails where productid = :id and isdeleted = 0 ";
    $this->db->query($sql);
    $this->db->bind(':id',$productid,PDO::PARAM_INT);
    $this->db->execute();
    if ($this->db->numRows() > 0){
    $productDetailsObject = $this->db->getdata();
    foreach ($productDetailsObject as $value){
    $productdetails = new productdetails($value->id,$value->productid,$value->color,$value->s,$value->m,$value->l,$value->xl,$value->xxl,$value->xxxl,$value->sold,$value->imageUrl);
    $this->productDetails[] = $productdetails;

    }     
         
    }
    
    
    
    
}
    
    
function deleteProduct($productID){
         $this->getvalidation();

     $this->validation->validateNumber($productid,1,100000);
     $this->connect();
      $sql = "update product set isdeleted=1 where id=:id";
          $this->db->query($sql);

      $this->db->bind(':id',$productID,PDO::PARAM_INT);
      $this->db->execute();
    
     $sql = "update subcategorydetails set isdeleted=1 where productid=:id";
          $this->db->query($sql);
      $this->db->bind(':id',$productID,PDO::PARAM_INT);
      $this->db->execute();


}


    
    
    
    
}
    
    
    
?>