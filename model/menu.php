
<?php
require_once("../model/Model.php");
require_once("../model/category.php");

class menu extends Model {
    
protected $categories;


function __construct() {
   $this->categories[]=new category();
}
    
public function getCategories(){
    return $this->categories;
}
public function getAllCategoriesDetails(){
    $sql="select id,name from category where isdeleted=0";
    $this->connect();
    $this->db->query($sql);
    $this->db->execute();
    if ($this->db->numRows()>0){
     $categories = $this->db->getdata();
    foreach ($categories as $value) {
        $this->categories[]=new category($value->id,$value->name);
    }
    } 
}
    
    

/*
 public function getAllCategoriesName($catid=""){
   
    $sql="select id,name from category where isdeleted=0";
    $this->connect();
    $this->db->query($sql);
    $this->db->execute();
    if ($this->db->numRows()>0){
        $categories = $this->db->getdata();
        if($catid==""){
        $catid=$categories[0]->id;
        }else{
        $catid=$catid;
        }
        $this->categories[0]->readSubCategories($catid);
        
        $idsub=$this->categories[0]->getSubcategories()[0]->getID();
        
        $this->categories[0]->getsubCategories()[0]->readProducts($idsub);
        $flag=0
        
    foreach ($categories as $value) {
        $this->categories[]=new category($value->id,$value->name,$flag);
    }
    }  
}*/

    
    
    

}

?>
