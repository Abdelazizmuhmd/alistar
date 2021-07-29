<?php
require_once("../database/db.php");
require_once("../database/validation.php");

//require_once("../other/customError.php");

abstract class Model{
   
    public $db;
    protected $validation; 

     public function getvalidation(){
       $this->validation=validation::getInstance(); 

     }
    public function connect(){
      
        $this->db = new Database();
    
    }
}
?>