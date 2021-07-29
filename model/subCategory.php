<?php
  require_once("../model/Model.php");
  require_once("../model/product.php");

?>
<?php
class subCategory extends Model
{
    private $name;
    private $id;
    private $products;



    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

       function __construct0()
    {
        $this->products[]= new product();
    }



     function __construct2($id,$name)
    {
        $this->id = $id;
        $this->name =$name;
       // $this->products[]= new product();

    }

    function setName($name)
    {
      $this->name = $name;
    }
    function getName()
    {
      return $this->name;
    }
    function setID($id)
    {
      $this->id = $id;
    }
    function getID()
    {
      return $this->id;
    }
    function getProducts(){
        return $this->products;
    }

    function readOneProduct($id){
        $this->products[0]=new product($id);

    }

    function readProducts($subcategoryId,$start)
    {
      $this->getvalidation();
      $this->validation->validateNumber($subcategoryId,1,30);
      $this->validation->validateNumber($start,1,30);
      $this->connect();
      $sql = "SELECT subcategorydetails.productid FROM subcategorydetails join subcategory on subcategorydetails.subcategoryid = subcategory.id JOIN product on product.id= subcategorydetails.productid where subcategorydetails.subcategoryid = :id and subcategory.isdeleted = 0 and product.isdeleted=0 limit $start, 10";
      $this->db->query($sql);
      $this->db->bind(':id',$subcategoryId,PDO::PARAM_INT);
      $this->db->execute();
      if ($this->db->numRows() > 0){
          $row = $this->db->getdata();
          $n = $this->db->numRows();
          for($i = 0;$i<$n;$i++)
          { $productid=$row[$i]->productid;
            
             $this->products[]=new product($productid);
             
           
           
           
          }}
    }

   function insertSubCategory($categoryid,$name)
    {    $name = trim($name);
             $this->getvalidation();

         $this->validation->validateMixedString($name,1,30);
         $this->validateNameIsUnique($name);
         $this->validation->validateNumber($categoryid,1,30);


       $this->connect();
      $sql = "INSERT into subcategory(name) values(:name)";
      $this->db->query($sql);
      $this->db->bind(':name',$name,PDO::PARAM_STR);
      $this->db->execute();
      $subcategoryid=$this->db->lastInsertedId();

      $sql = "INSERT into categorydetails(subcategoryid,categoryid) values(:subcategoryid,:categoryid)";
      $this->db->query($sql);
      $this->db->bind(':subcategoryid',$subcategoryid,PDO::PARAM_INT);
      $this->db->bind(':categoryid',$categoryid,PDO::PARAM_INT);

      $this->db->execute();




    }
      function validateNameIsUnique($name){
                   $this->connect();

    $sql= "select name from subcategory where name=:name and isdeleted=0";
    $this->db->query($sql);
      $this->db->bind(':name',$name,PDO::PARAM_STR);
      $this->db->execute();
      if ($this->db->numRows() > 0){
          
          header("location: ../public/error.html");   
          die();
              
      }
        
    }

    function updateSubCategory($id,$name)
    {
        $name=trim($name);
      $this->getvalidation();
         $this->validation->validateNumber($id,1,30);
         $this->validation->validateMixedString($name,1,30);
      $this->connect();
      $sql = "UPDATE subcategory set name = :name where id = :id";
      $this->db->query($sql);
      $this->db->bind(':id',$id,PDO::PARAM_INT);
      $this->db->bind(':name',$name,PDO::PARAM_STR);
      $this->db->execute();

    }
    function deleteSubCategory($subcategoryid)
    {     $this->getvalidation();
         $this->validation->validateNumber($subcategoryid,1,30);

      $this->connect();
      $sql = "update subcategory set isdeleted=1 where id=:id";
      $this->db->query($sql);
      $this->db->bind(':id',$subcategoryid,PDO::PARAM_INT);
      $this->db->execute();

    }
}








?>
