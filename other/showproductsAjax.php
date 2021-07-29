<?php

require_once("../model/menu.php");
require_once("../controller/adminController.php");
require_once("../view/adminproducts.php");
if(!isset($_REQUEST['numRows']) || !isset($_REQUEST['subcategoryid']) ){
 header("location:../public/products.php");

}
$numRows = $_REQUEST['numRows'];
$subcategoryid= $_REQUEST['subcategoryid'];

$model = new menu();
$controller=new adminController($model);

$view = new adminproductsView($model,$controller);
$model->getCategories()[0]->getSubcategories()[0]->readProducts($subcategoryid,$numRows);
echo $view->products();
?>