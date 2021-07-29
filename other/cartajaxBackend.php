 <?php 
 require_once("../database/db.php");
 

if(!isset($_REQUEST['productdetailid']) ||!isset($_REQUEST['imageurl']) ||
	!isset($_REQUEST['productname']) ||!isset($_REQUEST['productprice']) ||
	!isset($_REQUEST['colors']) ||!isset($_REQUEST['sizes']) ||
	!isset($_REQUEST['quantity'])){
header("location:../public/products.php");


}
$productdetail_id=$_REQUEST['productdetailid'];
$product_image=$_REQUEST['imageurl'];
$product_name=$_REQUEST['productname'];
$ProductPrice=$_REQUEST['productprice'];
$color=$_REQUEST['colors'];
$size=$_REQUEST['sizes'];
$quantity=$_REQUEST['quantity'];
$NewArr=array();

     $db = new Database();
     $sql="select * from productdetails where id = '$productdetail_id'" ;
     $db->query($sql);
     $db->execute();
     $x = $db->getdata()[0];
     $small_d = $x->s;
     $medium_d = $x->m;
     $large_d = $x->l;
     $xlarge_d = $x->xl;
     $xxlarge_d = $x->xxl;
     $xxxlarge_d = $x->xxxl;



$flag=0;
if(isset($_COOKIE['cook'])){
    $products= json_decode($_COOKIE['cook'],true);
    foreach($products as $product){
    	if($product['id'] == $productdetail_id && $product['size'] == $size){


            if($product['size'] == "Small"){
                if( $quantity + $product['quantity'] > $small_d){
                        $quantity = $small_d;
                        $flag =1;
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }else if($product['size'] == "Medium"){
                if($quantity  + $product['quantity']  > $medium_d){
                       $quantity = $medium_d;
                        $flag =1;   
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }else if($product['size'] == "Large"){
                if($quantity  + $product['quantity']  > $large_d){
                       $quantity = $large_d;
                        $flag =1;   
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }else if($product['size'] == "XL"){
                if($quantity   + $product['quantity'] > $xlarge_d){
                       $quantity = $xlarge_d;
                        $flag =1;   
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }else if($product['size'] == "XXL"){
                if($quantity  + $product['quantity'] > $xxlarge_d){
                       $quantity = $xxlarge_d;
                        $flag =1;   
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }else if($product['size'] == "XXXL"){
                if($quantity  + $product['quantity']  > $xxxlarge_d){
                       $quantity = $xxxlarge_d;
                        $flag =1;   
                }else{
                        $product['quantity']+=$quantity;
                        $flag=1;
                }
            }
              
    	}

        $NewArr[]=$product;   
            
    } 
}

if($flag ==1){


$j=json_encode($NewArr);

$expire = time() + 60*60*24*30;

setcookie('cook',$j,$expire,'/');



header("location:../public/cart.php");
}else{
$productt = array('id'=>$productdetail_id,'name'=>$product_name,"image_url"=>$product_image,"color"=>$color,"size"=>$size, "quantity"=>$quantity,"price"=>$ProductPrice);


$NewArr[]=$productt;

$j=json_encode($NewArr);

$expire = time() + 60*60*24*30;

setcookie('cook',$j,$expire,'/');



header("location:../public/cart.php");
}



  ?>