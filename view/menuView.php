<?php
require_once("../view/View.php");
require_once("header.php");

define("taxes", $lang['taxes']);
define("addtocart", $lang['addtocart']);
define("size", $lang['size']);
define("quantity", $lang['quantity']);
define("color", $lang['color']);
define("description", $lang['description']);

class menuView extends View{

    function MenuOutput(){
    $str="";
    $categories = $this->model->getCategories();
    foreach($categories as $i=>$category){
    if ($i>0) {
    $subCategories = $category->getSubcategories();
          $str.='<li class="site-nav--has-submenu site-nav__item">';
          $str.='<button class="site-nav__link btn--link site-nav__expand" aria-expanded="false" aria-controls="Collapsible-'.$i.'">';
          $str.=''.$category->getName().'';
          $str.='<span class="site-nav__link__text" aria-hidden="true">+</span>';
          $str.='</button>';
          $str.='<ul id="Collapsible-'.$i.'" class="site-nav__submenu site-nav__submenu--collapsed" aria-hidden="true" style="display: none;">';
          if(is_iterable($subCategories)){
          foreach($subCategories as $k=>$subcategory){
          $str.='<li>';
          $str.='<a value='.$subcategory->getID().' id="'.$i.'" href="../public/products.php?action=readProducts&subcategoryId='.$subcategory->getID().'" class="site-nav__link">'.$subcategory->getName().'</a>';
          $str.='</li>';}};
          $str.='</ul></li>';

}
    }
    echo $str;
    }

//305 460
    function productsOutput(){
     
     $str="";
     $products=$this->model->getCategories()[0]->getSubcategories()[0]->getProducts();
       foreach($products as $i=>$product){
       if ($i>0){
       $productDetails = $product->getProductDetails();
        if(is_iterable($productDetails)){
       foreach($productDetails as $k=>$productdetail){
       $imageArray=$productdetail->getImages();
                   if(is_iterable($imageArray)){

     $str.='<div class="product grid__item medium-up--one-third small--one-half slide-up-animation animated" id="stitem" role="listitem"style="">';

     $str.=' <div class="supports-js" style="max-width: 600px; margin: 0 auto;">';
     $str.=' <a href="../public/product.php?action=readOneProduct&productid='.$product->getId().'&productdetailid='.$productdetail->getid().'" class="product__image-wrapper " style="padding-top:100.0%;"  data-image-link>';
     $str.='<img class="product__image "
                 alt="first image"
                 style="max-width: 600px; max-height: 600px;"
                 src="'.$imageArray[0].'grande.jpeg"
                 data-widths="[180, 360, 540, 720, 900, 1080, 1296, 1512, 1728, 2048]"
                 data-aspectratio="1.0"
                 data-sizes="auto"
                 data-image>
      </a>';
     $str.=' </div>';
     $str.=' <div  class="product__title product__title--card titlesname text-center">';
     $str.=' <a href="" class="options">'.$product->getName().' - '.$productdetail->getColor().'</a>';
     $str.=' </div>';
     $str.='  <div " class="product__prices text-center">';
     $str.=' <span class="product__price" >';
     if((int)($product->getoldpricce()) != "0"){
        $str.=' <s><span class="visually-hidden">Regular price</span>'.(int)($product->getoldpricce()).' L.E</span></s>';
    }else{
        $str.=' <s><span class="visually-hidden">Regular price</span>'."".'</span></s>';
    }
     
     $str.=' <span class="visually-hidden">Regular price</span>'.(int)($product->getprofit()+$product->getcost()).' L.E</span>';
     $str.=' <span class="badge badge--sale"></span>';            
     $str.=' </div>';
     $str.=' </div>';


       }}}
    }

       }

        $arr[]=$str;
        $arr[]=(count($products)-1);
        $arr=json_encode($arr);
       echo $arr;

    
    }
    function readOneProduct(){
          $counterid = 0;
        if(isset($_REQUEST['productdetailid'])&&isset($_REQUEST['productid'])){
     if(!is_numeric($_REQUEST['productdetailid'])){
         $str="<h1>Bad Request<h1>";
         echo $str;
       die();
    }else if(strlen($_REQUEST['productdetailid'])<1||strlen($_REQUEST['productdetailid'])>100000){
        $str="<h1>Bad Request<h1>";
         echo $str;
          die();
    }
            
        $str="";
        $product= $this->model->getCategories()[0]->getSubcategories()[0]->getProducts()[0];
        $productdetails = $product->getProductDetails();
        $hidden="";
        $display="";
        $pid = $_REQUEST['productdetailid'];
        if(is_iterable($productdetails)){ 
           $flag=0;
             foreach($productdetails as $i=> $productdetail){
             if($productdetail->getid()==$pid){
             $flag=1;         
             }
             
             }
            if($flag==0){
              $str="<h1>Bad Request<h1>";
                echo $str;
                 die();
            }
            
        foreach($productdetails as $i=> $productdetail){
            
                //here is islam
         if($productdetail->getid()!=$pid/*$i != 0*/){ $hidden="hidden";$display='display:none;';}
         else $display='display:block;';
         $str.='   <div id="ProductImageWrapper-13801390768162" class="product-single__featured-image-wrapper supports-js images" value= '.$productdetail->getColor().'  style='.$display.'>';
         $str.=' <div class="product-single__photos" data-aspectratio="1.0"  >';
         $str.='<div src="" style ="position: relative; height: 100%; overflow: hidden;" id="displayPic'.$productdetail->getColor().'" class="tile" data-scale="1.6">';
         $str.='</div>';
         $str.='<div class="album" style = "display:flex; flex-flow: wrap;">';
         $i++;
         $p=0;
         $counter = 0;
         $imagess=$productdetail->getImages();
       if(is_iterable($imagess)){
         foreach($imagess as $img){
         //$str.='<div class="numbertext"> / '.count($productdetail->getImages()).'</div>';
         //$str.='<div src="" style ="position: relative; height: 100%; overflow: hidden;" class="tile" data-scale="1.6">';
         if($display=="display:block;"){
          $str.='<div class="oimage">';
           $str.='<img col='.$productdetail->getColor().'  id="sel'.$productdetail->getColor().''.$counter.'" class="product-single__photo '.$productdetail->getColor().'1"  src="'.$img.'originalphoto.jpeg" onclick="changeImage('.$counter.',\''.$productdetail->getColor().'\')" >';
          $str.='</div>';
             }else{
               $str.='<div class="oimage">';
                $str.='<img col="'.$productdetail->getColor().'" id="sel'.$productdetail->getColor().''.$counter.'" src="" class="product-single__photo '.$productdetail->getColor().'1" data-src="'.$img.'originalphoto.jpeg" onclick="changeImage('.$counter.',\''.$productdetail->getColor().'\')" >';
               $str.='</div>';
            }
          //  $str.='</div>';
          $counter++;
         }
        /*$str.='<a style = " margin-bottom:250px; height:50px" class="prev but'.$productdetail->getColor().'" onclick="plusSlides(-1)">&#10094;</a>
         <a  style = "margin-bottom:250px;height:50px"class="next but'.$productdetail->getColor().'" onclick="plusSlides(1)">&#10095;</a>
         </div>
         <br>';*/
         //$str.='<div style="text-align:center">';
         //$imagesLength=count($productdetail->getImages());
         //for($i=1;$i<=$imagesLength;$i++)
        /* $str.='<span class="dot col'.$productdetail->getColor().'" onclick="currentSlide('.$i.')"></span>';*/
         $str.='</div>';
         $str.='</div>';
         $str.='</div>';
         }
        }
         $str.=' </div>

         <div class="grid__item medium-up--one-half" >

             <div class="product-single__meta small--text-center deciding" id="selectorContainer">

                 <h1 id ="product_name1" class="product-single__title" itemprop="name">'.$product->getName().'</h1>';
                 $display ='';
                 $pid = $_REQUEST['productdetailid'];
        
                 foreach($productdetails as $i=> $productdetail){
                     //here is islam
                     //echo $productdetail->getid();


                  if($productdetail->getid()!=$pid /*$i!=0*/){
                      $hidden="hidden";$display='display:none;';
                           }
                  else $display='display:block;';

                       if((int)($product->getoldpricce()) != "0"){


 $str.= '<div class="selectorsC" id = '.$productdetail->getColor().' style='.$display.'>
            

                     <p class="product-single__prices">
                     <s><span id="ProductPrice" class="product-single__price" value="'.(int)($product->getoldpricce()).'">'.(int)($product->getoldpricce()).' L.E</span></s>
                         <span id="ProductPrice" class="product-single__price" value="'.(int)($product->getCost()+$product->getProfit()).'">'.(int)($product->getCost()+$product->getProfit()).' L.E</span>
                     </p>';
                       }else{
 $str.= '<div class="selectorsC" id = '.$productdetail->getColor().' style='.$display.'>
            

                     <p class="product-single__prices">
                         <span id="ProductPrice" class="product-single__price" value="'.(int)($product->getCost()+$product->getProfit()).'">'.(int)($product->getCost()+$product->getProfit()).' L.E</span>
                     </p>';

                       }

               

                     $str.= '<div class="product-single__policies rte">'.taxes.'


                     </div>
                   
                         <div  class="product-form" >
                            <input type="text" name="productdetailid" value="'.$productdetail->getid().'" hidden>
                            <input type="text" name="productname" value="'.$product->getName().'" hidden>
                            <input type="text" name="productprice" value="'.(int)($product->getCost()+$product->getProfit()).'" hidden>
                            <input type="text" name="imageurl" value="'.$productdetail->getArray()[0].'" hidden>
                    
                            <input type="text" id="product_id'.$counterid.'" name="productdetailid" value="'.$productdetail->getid().'" hidden>
                            <input type="text" id="product_name" name="productname" value="'.$product->getName().'" hidden>
                            <input type="text" id="product_cost" name="productprice" value="'.(int)($product->getCost()+$product->getProfit()).'" hidden>
                            <input type="text" id="product_img'.$counterid.'" name="imageurl" value="'.$productdetail->getArray()[0].'" hidden>


                         <div class="selector-wrapper">
                            <label for="ProductSelect-product-template-option-0">'.color.'</label>
                             <select class="single-option-selector decider" data-option="option1"
                                 id="ProductSelect-product-color-option-'.$counterid.'"  name="colors"  check="'.$display.'" >';
                                 foreach($productdetails as $pro){
                                   if($productdetail->getColor() == $pro->getColor())
                                     $str.='<option selected = "selected" value="'.$pro->getColor().'">'.$pro->getColor().'</option>';
                                   else
                                     $str.='<option value="'.$pro->getColor().'">'.$pro->getColor().'</option>';
                                  }
                            $str.=' </select>
                         </div>
                         <div class="selector-wrapper decdiv">
                             <label for="ProductSelect-product-template-option-1">'.size.'</label>
                             <select class="single-option-selector quantity" data-option="option2"
                                 id="ProductSelect-product-size-option-'.$counterid.'" name="sizes">';

                                  if($productdetail->getSmall() > 0)
                                    $str.='<option id ="'.$productdetail->getSmall().'"value="Small">Small</option>';
                                  if($productdetail->getMedium() > 0)
                                    $str.='<option id ="'.$productdetail->getMedium().'" value="Meduim">Meduim</option>';
                                  if($productdetail->getLarge() > 0)
                                    $str.='<option id ="'.$productdetail->getLarge().'" value="Large">Large</option>';
                                  if($productdetail->getXl() > 0)
                                    $str.='<option id ="'.$productdetail->getXl().'" value="XL">XL</option>';
                                  if($productdetail->getXxl() > 0)
                                    $str.='<option id = "'.$productdetail->getXxl().'" value="XXL">XXL</option>';
                                  if($productdetail->getXxxl() > 0)
                                    $str.='<option id = "'.$productdetail->getXxxl().'" value="XXXL">XXXL</option>';
                           $str.='</select></div>


                         <div class="product-single__quantity qdiv">
                             <label for="Quantity">'.quantity.'</label>
                             <input type="number" class="qbutton" id="Quantity'.$counterid.'" name="quantity" value="1" min="1">
                         </div>


                         <div class="product-single__cart-submit-wrapper  product-form--full">
                       <input type="submit" onclick="addToCart('.$counterid.')" value= "'.addtocart.'" name="add" id="AddToCart"
                               class="btn product-single__cart-submit btn--full  btn--secondary">



                         </div>


                 </div>
                 
                 </div>
 ';

$counterid = $counterid + 1;

                                }
    
        

                $str.= '<div class="product-single__description rte" itemprop="description"><h1>
                    '.description.'</h1>

                     '.$product->getDescription().'
                     <br>                     <br>
                     <br>




                  ';
            $str.='<div class="table-responsive dynamic" data-unit-system="metric">
                            <div class="rte__table-wrapper">
                                <table cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <td>&nbsp;</td>
                                           
                                           
                                            <td><strong>L</strong></td>
                                            <td><strong>XL</strong></td>
                                            <td><strong>2XL</strong></td>
                                            <td><strong>3XL</strong></td>
                                             <td><strong>4XL</strong></td>
                                           
                                        </tr>
                                        <tr>
                                            <td><strong>Length (cm)</strong></td>
                                            <td>31</td>
                                            <td>33</td>
                                            <td>35</td>
                                            <td>37</td>
                                            <td>39</td>
                                           
                                       
                                        </tr>
                                        <tr>
                                            <td><strong>Width (cm)</strong></td>
                                            <td>41</td>
                                            <td>43</td>
                                            <td>45</td>
                                            <td>47</td>
                                            <td>49</td>
                                          
                                      
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';

}else{
      $str="<h1>Product not Found<h1>";
        }




        echo $str;
    }else{
               $str="<h1>Product not Found<h1>";
             echo $str;
         }


}
}

?>
