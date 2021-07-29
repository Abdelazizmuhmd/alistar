<?php
require_once("../model/menu.php");
require_once("../controller/menuController.php");
require_once("../view/menuView.php");
$model = new menu();
$controller= new menuController($model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
 if(method_exists($controller,$_GET['action'])){
    $controller->{$_GET['action']}();
    }else{
     header("location: ../public/products.php");
 }
}
$controller->getAllCategoriesDetails();
$view= new menuView($model,$controller);

?>
<!doctype html>
<html>
<head>
<link href="../images/lgo.jpeg" rel="icon">  
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170289627-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-170289627-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>alistar - Product</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="../css/home.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/slider.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/photo.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/footer.css" rel="stylesheet" type="text/css" media="all" /> 
    <script src="../js/home.js" type="text/javascript"></script>
    <script src="../js/product.js" type="text/javascript"></script>
    <script src="../js/zoom.js" type="text/javascript"></script>
</head>
<body>

<?php
    include_once("../public/header.php");
?>

<div class="site-wrapper">
<div class="grid">
<img src="../images/lgo.jpeg" style="margin-bottom:30px; margin-left:60px; width:100px;height:125px;">
<?php
include("menu.php");
?>
<main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">
<hr class="hr--border-top small--hide">
<div class="grid product-single">
<div class="grid__item medium-up--one-half" id="sthalf">
<?php
$view->readOneProduct();

?>
</div>
</div>
</main>
</div>
<hr>
</div>
<?php 
if(isset($_REQUEST['productid'])){           
echo "<input type='text' id='productid' value=".$_REQUEST['productid']." hidden>";}
?>

<?php
    include("../public/footer.php");
 ?>
</body>
<script src="../js/productjs.js" type="text/javascript"></script>
</html>