<?php
require_once("../view/View.php");
class shippingView extends View{


function getShippingData(){ 
    $str="";

$orders =  $this->model->getordersArray();
foreach($orders as $i=> $order){
if($i>1){
$str.="<tr>";
$str.="<td>";

$str.="</tr>";

    
}
}}
}
    

?>