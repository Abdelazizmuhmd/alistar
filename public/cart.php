<?php

require_once("../model/menu.php");
require_once("../controller/menuController.php");
require_once("../view/menuView.php");
$model = new menu();
$controller= new menuController($model);
$controller->getAllCategoriesDetails();
$view= new menuView($model,$controller);
?>

<html >
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-170289627-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-170289627-1');
</script>
<link href="../images/lgo.jpeg" rel="icon">  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>alistar - Cart</title>    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="../css/footer.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/home.css" rel="stylesheet" type="text/css" media="all" /> 
<script src="../js/home.js" type="text/javascript"></script>
</head>    
<body >
<?php
include_once("../public/header.php");
?>

<div class="site-wrapper">
<div class="top-bar grid">
<a  href="../public/products.php" > <img  src="../images/lgo.jpeg" style="margin-bottom:30px; margin-left:70px; width:100px;height:125px;" >  </a>
<?php
        include("menu.php");
?>
<main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">
<hr class="hr--border-top small--hide">
<div class="grid">
<div class="grid__item">
<h1 class="h2 visually-hidden">Shopping Cart</h1>
<form method="post" action="../public/checkout.php" novalidate="" class="cart pf-form-processed">
<h1>Cart</h1>
<div id="carttables">      
</div>
<hr>
<footer class="cart__footer">
          <div class="grid" style="margin-top:100px;" >
            <div class="grid__item large-up--one-half">
              <label for="CartSpecialInstructions" class="label--block">alistar.shop</label >
              <textarea  name="note" id="CartSpecialInstructions" class="input--block cart__note" hidden></textarea>
            </div>
            <div class="grid__item text-center large-up--one-half large-up--text-right"><p>
             <span class="cart__subtotal-title h3">Subtotal</span>
             <span class="cart__subtotal h3">
            <span  id="subtotalprice"class="hulkapps-cart-original-total">        
            </span></span>
              </p><p class="cart__policies txt--emphasis rte">Tax included. Delivered to your door</p>
              <p>
              <a class="btn btn--secondary" href="../public/products.php">Continue shopping</a>
              </p>
              <p>
              <input type="submit" name="checkout" class="btn" id="checkout" value="Check Out">
              </p>
            </div>
          </div>
        </footer>
</form> 
</div>
</div>
</main>
</div>
<hr>
</div>  
<?php
include("../public/footer.php");
 ?>
<script src="../js/cartjs.js" type="text/javascript"></script>

<script>
    
    if(document.getElementsByClassName("cart-table responsive-table table--no-border").length == 0){
        document.getElementById("checkout").style.visibility="hidden";
    }
</script>
</body>
</html>
