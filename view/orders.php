  <?php

require_once("View.php");

class ordersview extends View{

function output(){
$i=0;
$str = "";
if(count($this->model->getordersArray())>0){
foreach($this->model->getordersArray() as $orders){
  if($i>0){
            $str.="<tr>";
            $str.="<td>".$i."</td>";
if($_SESSION['usertype']=="admin"){
            $str.="<td>".$orders->getuser()->getID()."</td>";
            $str.="<td>".$orders->getuser()->getfirstName()." ".$orders->getuser()->getlastName() ."</td>";
            $str.="<td>".$orders->getuser()->getEmail()."</td>";
            $str.="<td>".$orders->getuser()->getPhone()."</td>";
            $str.="<td>".$orders->getuser()->getAddress()."</td>";
            $str.="<td>".$orders->getuser()->getApartmant()."</td>";
            $str.="<td>".$orders->getuser()->getCity()."</td>";
            $str.="<td>".$orders->getuser()->getuserType()."</td>";
      }
            $str.="<td>".$orders->getId()."</td>";
            $str.="<td>".$orders->getComment()."</td>";
            $str.="<td>".$orders->getStatus()."</td>";
            $str.="<td>".$orders->getCreatedtime()."</td>";
  
                  $str.="<td><a class='update'style='color:#28a745;font-size:16px;' id='button' href='clientproducts.php?userid=".$orders->getUserid()."&orderid=".$orders->getId()."'>View</a></td>";

            if($_SESSION['usertype'] == 'admin')
                    {
                $str.="<td>";
                
                $pending="";
                $perparing="";
                $finshed="";
                $Delivered="";
               $str.= '<div class="selectWrapper">';
                
                if($orders->getStatus()=="Pending"){
                    $pending="selected ";
                    $str.="<select id='select_box' class='selectBox' style='color:#15A0F0;' >";
                 
                }else if($orders->getStatus()=="Preparing"){
                     $str.="<select id='select_box' class='selectBox' style='color:#DF9420;' >";
                    $perparing="selected";
                }else if($orders->getStatus()=="Finished"){
                     $str.="<select id='select_box' class='selectBox'style='color:#AF06D5' >";
                    
                    $finshed="selected selected  ";
                }
                else if($orders->getStatus()=="Delivered"){
                     $str.="<select id='select_box' class='selectBox'style='color:#F90088;' >";
                    $Delivered="selected";
                }
                $str.="<option value='Pending' oid='".$orders->getId()."' $pending >Pending</option>";
                $str.="<option oid='".$orders->getId()."' $perparing value='Preparing'>Preparing</option>";
                $str.="<option oid='".$orders->getId()."' $finshed value='Finished'>Finished</option>";
                $str.="<option oid='".$orders->getId()."' $Delivered value='Delivered'>Delivered</option>";
                $str.="</select>";
                $str.="</div>";
                $str.="</td>";

                
                
                    
            $str.="<td><a id='button' class='Delete' style='color:red;font-size:16px;'onclick='return confirm('Delete this order?');' href='orders.php?action=delete&orderid=".$orders->getId()."'>Delete</a></td>";
            }
            $str.="</tr>";
          }
            $i++;

}
}

                      return $str;

}

}

?>