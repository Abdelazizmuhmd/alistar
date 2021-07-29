<?php       
ob_start(); 
require_once("../model/user.php");
require_once("../controller/checkoutController.php");
require_once("../view/checkOut.php");
session_start();
$model = new user();
$controller = new checkOutController($model);
if(isset($_SESSION['id'])){
    $controller->getuser($_SESSION['id']);
}
$view=new viewCheckOut($model,$controller);
if (isset($_GET['action']) && !empty($_GET['action'])) { 
    if(isset($_SESSION['id'])){   
   
      $controller->makeorderclient(); 
    }else{  
        $controller->makeorderguest();
    }
    header("location:../public/recepit.php");
}
?>
<!DOCTYPE html>
<html  class="no-js desktop page--no-banner page--logo-main page--show page--show card-fields">
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
<meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0">
<title>alistar - Checkout</title>
<link rel="stylesheet" media="all" href="../css/checkoutcss.css" />
<script src="../js/check_Out.js" type="text/javascript" ></script>  
</head>
<body>

<div class="content" data-content>
<div class="wrap">
<div class="main">
<header class="main__header" role="banner">
<h1 >
Information
</h1>
</header>
<main class="main__content" role="main">
<div class="step" data-step="contact_information" data-last-step="false">
<?php
$view->userdetails();
?>
</div>
</main>
</div>
<aside class="sidebar" role="complementary">
<div class="sidebar__header">
<h1 class="visually-hidden">
Information
</h1>
</div>
<div class="sidebar__content">
<div id="order-summary" class="order-summary order-summary--is-collapsed" data-order-summary>
<h2 class="visually-hidden-if-js">Order summary</h2>
<div class="order-summary__sections">
<div class="order-summary__section order-summary__section--product-list">
<div class="order-summary__section__content">
<div id="tableoutput">
</div>
    
 <div class="order-summary__scroll-indicator" aria-hidden="true" tabindex="-1">
      Scroll for more items
<svg aria-hidden="true" focusable="false" class="icon-svg icon-svg--size-12"> <use xlink:href="#down-arrow" /> </svg>
</div>
    
</div>
</div>
<div class="order-summary__section order-summary__section--total-lines" data-order-summary-section="payment-lines">
<table class="total-line-table">
<caption class="visually-hidden">Cost summary</caption>
<thead>
    <tr>
      <th scope="col"><span class="visually-hidden">Description</span></th>
      <th scope="col"><span class="visually-hidden">Price</span></th>
    </tr>
  </thead>
    <tbody class="total-line-table__tbody">
      <tr class="total-line total-line--subtotal">
  <th class="total-line__name" scope="row">Subtotal</th>
  <td class="total-line__price">
    <span class="order-summary__emphasis" id="subtotalprice" data-checkout-subtotal-price-target="3000">
    </span>
  
  </td>
</tr>
  <tr class="total-line total-line--subtotal">
  <th class="total-line__name" scope="row">Delivery</th>
  <td class="total-line__price">
    <span class="order-summary__emphasis"  data-checkout-subtotal-price-target="3000">
        30 L.E
    </span>
  
  </td>
</tr>


</tbody>
  <tfoot class="total-line-table__footer">
    <tr class="total-line">
      <th class="total-line__name payment-due-label" scope="row">
        <span class="payment-due-label__total">Total</span>
          <span class="payment-due-label__taxes order-summary__small-text hidden" data-checkout-taxes>
            Including <span data-checkout-total-taxes-target="0">€0,00</span> in taxes
          </span>
      </th>
      <td class="total-line__price payment-due">
        <span  id="Totalprice" class="payment-due__price" data-checkout-payment-due-target="3000">

        </span>
      </td>
    </tr>
  </tfoot>
</table>

    </div>
  </div>
</div>
 </div>
</aside>
</div>
</div>
    <div id="productsCheckOut">
    
</div>
<script src="../js/checkoutjs.js" type="text/javascript" ></script> 


    
    </body>
    </html>
<?php
         ob_end_flush(); 

?>