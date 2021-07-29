<?php 
require_once("../view/View.php");
class adminproductsView extends View{

function getallcategories(){
$str="";
$categories = $this->model->getCategories();
$str.='<select name="categories" id="catselection" class="form-control categories combBox" onclick=" show_div()">';
$str.='<option disabled selected value> -- select an option -- </option>
';
foreach($categories as $i=>$category){
    
if($i>0){
    
$str.='<option value="'.$category->getId().'">'.$category->getName().'</option>';
}}
$str.='</select>';
$str.='<script>';
$str.='$(document).ready(function() {';
$str.='$(".categories").change(function() {';
$str.=' var val = $(this).val();';
$str.='document.getElementById("editcatgoryid").value =val;';
$str.='document.getElementById("deletecategoryid").value =val;';
$str.='document.getElementById("categoryid").value =val;';

$str.='if(1==0){}';

foreach($categories as $u=>$category){
 if($u>0){
 $subcategories=$category->getSubcategories();     
 $str.='else if (val == "'.$category->getId().'"){';
 $str.='$(".subcategory").html("'; 
if(is_iterable($subcategories)){
 foreach($subcategories as $k=>$subcategory){
 $str.='<option value='.$subcategory->getID().'>'.$subcategory->getName().'</option>';
    } }

  $str.='");}';

}}

$str.='});});';
$str.='</script>';
 
    return $str;
}
    
  
    


/*
function categoryoutput(){
  $str = "";
  $catarr = $this->model->getcategories();
  for($i = 1;$i<count($catarr);$i++)
   $str .= "<option>".$catarr[$i]->getName()."</option>";
  return $str;
}


function subcategoryoutput(){
  $str = "";
  $subarr = $this->model->getcategories()[]->getsubcategories();
  for($i = 0;$i<count($subarr);$i++)
   $str .= "<option>".$subarr[$i]->getName()."</option>";
  return $str;
}
*/

function products(){
    $rowIndex=1;
  $productarr = $this->model->getcategories()[0]->getsubcategories()[0]->getproducts();
  $str ="";
    $length=count($productarr);
  for ($i = 1;$i<$length;$i++)   
  { 
    $details = $productarr[$i]->getProductDetails();
    if(is_iterable($details)){
    $dlength=count($details);  
    for($j = 0;$j<$dlength;$j++)
     { 
         $str .= "
         
         <tr id='".$rowIndex."'>
            <td><img src='".$details[$j]->getArray()[0]."small.jpeg' style='width
            :50px;height:50px;position: relative;'></td>
            <td >".$productarr[$i]->getid()."</td>
            <td style='display:none' >".$details[$j]->getid()."</td>
            <td><div name ='name' class = 'editor' >".$productarr[$i]->getName()."</div></td>
            <td><div name ='cost' value=".$productarr[$i]->getCost()." class = 'editor' >".$productarr[$i]->getCost()."</div>L.E</td>
            <td><div name ='profit' value=".$productarr[$i]->getProfit()." class = 'editor' >".$productarr[$i]->getProfit()."</div>L.E</td>
            <td><div name ='code' class = 'editor' >".$productarr[$i]->getCode()."</div></td>
            <td><div name ='description' class = 'editor' >".$productarr[$i]->getDescription()."</div></td>
            <td><div name ='color' class = 'editor' >".$details[$j]->getColor()."</div></td>
            <td><div name ='small' class = 'editor' >".$details[$j]->getSmall()."</div></td>
            <td><div name ='medium' class = 'editor' >".$details[$j]->getMedium()."</div></td>
            <td><div name ='large' class = 'editor' >".$details[$j]->getLarge()."</div></td>
            <td><div name ='xlarge' class = 'editor' >".$details[$j]->getXl()."</div></td>
            <td><div name ='xxlarge' class = 'editor' >".$details[$j]->getXxl()."</div></td>
            <td><div name ='xxxlarge' class = 'editor' >".$details[$j]->getXxxl()."</div></td>
            <td><div name ='weight' class = 'editor' >".$productarr[$i]->getWeight()."</div></td>
            <td><a id='button' onclick='deleteRow(".$rowIndex.",".$details[$j]->getid().")'><i class='fa fa-trash'></i></a></td>
          </tr> 
          
          ";
        $rowIndex +=1 ;
     }}
     
 }
    $arr[]=$str;
    $arr[]=$length;
    $arr=json_encode($arr);
 return $arr;
}

}
?>