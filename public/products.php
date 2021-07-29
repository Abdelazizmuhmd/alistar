<?php
require_once("../model/menu.php");
require_once("../controller/menuController.php");
require_once("../view/menuView.php");

$model = new menu();
$controller= new menuController($model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if(method_exists($controller,$_GET['action'])){
    $controller->{$_GET['action']}();
    }
}
$controller->getAllCategoriesDetails();
$view= new menuView($model,$controller);
?>

<!doctype html>
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
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="../css/home.css" rel="stylesheet" type="text/css" media="all" /> 
  <link href="../css/products.css" rel="stylesheet" type="text/css" media="all" /> 
  <link href="../css/footer.css" rel="stylesheet" type="text/css" media="all" /> 
  <link href="../css/mainslider.css" rel="stylesheet" type="text/css" media="all" /> 
   <link href="../css/homeproducts.css" rel="stylesheet" type="text/css" media="all" /> 
  <title>alistar - Products</title> 
  <script src="../js/home.js" type="text/javascript"></script>
  <script src="../js/select.js" type="text/javascript"></script>

</head>
    
<body>
 <?php
    include_once("../public/header.php");
?>
    
    
<div> 
<div class="site-wrapper">
<div class="grid">
<div style="display:inline-block;margin-right:63px; ">
<a  href="../public/products.php" > <img  src="../images/lgo.jpeg" style=" margin-left:70px; width:100px;height:125px; display:block;" >  </a>
</div>
<div class="w3-content w3-display-container" style="margin-left:27px;display:inline-block;">
   <picture>
   <source srcset="../images/test1.jpg" media="(min-width: 550px)"/>
    <source srcset="../images/1.jpeg" media="(min-width: 100px)"/>
  <img src="https://via.placeholder.com/400" alt="example"  style=" margin-bottom: 25px;"/>
</picture>
<!--
<img class="mySlides" src="../images/1.jpeg" style="width:100% ">
<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
-->
</div>
<?php
include("menu.php");
?>
<main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">
<hr class="hr--border-top small--hide">
<div style='display:flex; width:100%; position:relative;'> 
<select name="CardiologyPassword" placeholder="Enter Cardiology Password" id="pname" class="form-control" required id="stat">
<option value="All" >Products</option>
</select>
<select name="CardiologyPassword" placeholder="Enter Cardiology Password" id="pcolor" class="form-control" required id="stat">
<option value="All" >Colors</option>
</select>
</div>             
<div style="padding-top:20px;" id="section-collection-template" class="section">
<div data-section-id="collection-template" data-section-type="collection-template" data-sort-enabled="true" data-tags-enabled="true">
<div class="grid grid--uniform" style="display:flex;  flex-flow:wrap;" id="products" role="list">
</div>
<button onclick="loadMoreProducts();"  id="loadmore" value="loadMore" class="buttonn buttonn1" >loadMore</button>
<input type="text" value="0" id="numRows" name="numRows" hidden>
<input type="text" value=""  id="subcategoryid" name="subcategoryid" hidden>
     

<?php if(isset($_GET['subcategoryId'])){
?>    
<script>      
document.getElementById("subcategoryid").value= <?php echo $_GET['subcategoryId']; ?>;
</script>
<?php }
else{
?>
<script>
if(document.getElementById("1") && document.getElementById("1").getAttribute("value"))
{   
  document.getElementById("subcategoryid").value=  document.getElementById("1").getAttribute("value");
}       
</script>     
<?php
} 
    ?>   

</div>
</div>
</main>
</div>
<hr>     
</div>   
</div>
    
    
<script src="../js/homejs.js" type="text/javascript">
    

</script>


<?php
include("../public/footer.php");
?>

<script>

    loadMoreProducts();

   
           
</script>
</body>
</html>
