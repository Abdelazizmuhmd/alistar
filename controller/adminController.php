<?php
require_once("../controller/Controller.php");
class adminController extends Controller{




function getAllCategories(){
    $this->model->getAllCategoriesDetails();
}

function addCategory(){
    if(isset($_REQUEST['newcategoryname'])){
    $categoryName = $_REQUEST['newcategoryname'];
    
    $this->model->getCategories()[0]->insertCategory($categoryName);
    }
}
function editCategory(){
if(isset($_REQUEST['newcategoryname'])&&isset($_REQUEST['editcatgoryid'])){
    $categoryName = $_REQUEST['newcategoryname'];
    $categoryId = $_REQUEST['editcatgoryid'];
    $this->model->getCategories()[0]->updateCategory($categoryId,$categoryName);
}}
    
function deletecategory(){
    if(isset($_REQUEST['deletecategoryid'])){
    $categoryId = $_REQUEST['deletecategoryid'];
    $this->model->getCategories()[0]->deleteCategory($categoryId);
    
}
}
    


function addsubcategory(){
    if(isset($_REQUEST['subcategoryname'])&&isset(($_REQUEST['categoryid']))){
     $subCategoryName = $_REQUEST['subcategoryname'];
     $categoryId = $_REQUEST['categoryid'];
     $this->model->getCategories()[0]->getSubcategories()[0]->insertSubCategory($categoryId,$subCategoryName);
        }
}
    
    
    function deletesubcategory(){
            if(isset($_REQUEST['deletesubcategoryid'])){

    $subCategoryId = $_REQUEST['deletesubcategoryid'];
    $this->model->getCategories()[0]->getSubcategories()[0]->deleteSubCategory($subCategoryId);
            }

}
    function editsubcategory(){
    if(isset($_REQUEST['newsubcategoryname'])&&isset($_REQUEST['editsubcatgoryid'])){

    $subCategoryName = $_REQUEST['newsubcategoryname'];
    $subCategoryId = $_REQUEST['editsubcatgoryid'];
    $this->model->getCategories()[0]->getSubcategories()[0]->updateSubCategory($subCategoryId,$subCategoryName);
}}


function readProducts(){
                if(isset($_REQUEST['subcategoryid'])){

    $subCategoryId = $_REQUEST['subcategoryid'];
    $this->modal->getCategories()[0]->getSubcategories()[0]->readProducts($subCategoryId);
}
}

function  insertProduct(){
    
if(isset($_REQUEST['name'])&&isset($_REQUEST['code'])&&isset($_REQUEST['cost'])&&isset($_REQUEST['profit'])&&isset($_REQUEST['description'])&&isset($_REQUEST['weight'])&&isset($_REQUEST['productDetails'])&&isset($_REQUEST['subcategoryid'])){

    $this->model->getCategories()[0]->getSubcategories()[0]->getProducts()[0]->insertProduct();
    $name = $_REQUEST['name'];
    $code = $_REQUEST['code'];
    $cost = $_REQUEST['cost'];
    $profit = $_REQUEST['profit'];
    $description = $_REQUEST['description'];
    $weight = $_REQUEST['weight'];
    $productDetails = $_REQUEST['productDetails'];
    $subcategoryid = $_REQUEST['subcategoryid'];
    $this->model->getCategories()[0]->getSubcategories()[0]->getProducts()[0]->insertProduct($name,$code,$cost,$profit,$description,$weight,$productDetails,$subcategoryid);

}
    
}
    
    
    
    
    
    
    
    
    
    
    
function showproducts($subid=""){
if($subid==""){
$subcategoryid=$_REQUEST['subproductid'];
}
 else{       $subcategoryid=$subid;
    }
$this->model->getCategories()[0]->getSubcategories()[0]->readProducts($subcategoryid,1);
}

function  updateProduct(){
    
if(isset($_REQUEST['productid'])&&isset($_REQUEST['productdetailid'])&&isset($_REQUEST['name'])&&isset($_REQUEST['code'])&&isset($_REQUEST['cost'])&&isset($_REQUEST['profit'])&&isset($_REQUEST['description'])&&isset($_REQUEST['weight'])&&isset($_REQUEST['color'])&&isset($_REQUEST['s'])&&isset($_REQUEST['m'])&&isset($_REQUEST['l'])&&isset($_REQUEST['xl'])&&isset($_REQUEST['xxl'])&&isset($_REQUEST['xxxl'])&&isset($_REQUEST['imageurls'])){
    
    $productid = $_REQUEST['productid'];
    $productdetailid = $_REQUEST['productdetailid'];
    $name = $_REQUEST['name'];
    $code = $_REQUEST['code'];
    $cost = $_REQUEST['cost'];
    $profit = $_REQUEST['profit'];
    $description= $_REQUEST['description'];
    $weight= $_REQUEST['weight'];
    $color= $_REQUEST['color'];
    $s= $_REQUEST['s'];
    $m= $_REQUEST['m'];
    $l= $_REQUEST['l'];
    $xl= $_REQUEST['xl'];
    $xxl= $_REQUEST['xxl'];
    $xxxl= $_REQUEST['xxxl'];
    $imageurls= $_REQUEST['imageurls'];
    $this->model->getCategories()[0]->getSubcategories()[0]->getProducts()[0]->update($productid,$productdetailid,$name,$code,$cost,$profit,$description,$weight,$color,$s,$m,$l,$xl,$xxl,$xxxl,$imageurls);

}}
function  deleteProduct(){
    if(isset($_REQUEST['productdetailid'])){
    $productID = $_REQUEST['productdetailid'];
    $this->model->getCategories()[0]->getSubcategories()[0]->getProducts()[0]->getProductDetails()[0]->delete($productID);
    }
}




}

?>
