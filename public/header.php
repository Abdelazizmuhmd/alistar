
<div style="margin-bottom:20px;">
    
<nav class="navbar navbar-expand-md navbar-light bg-success" style="background-color:#58595b;">
    <a href="https://www.alistar.shop" class="navbar-brand" style="color: white;">alistar store</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <?php
            if (session_status() == PHP_SESSION_NONE) {

            session_start();
            }
       require_once("langbuttons.php");

      if(!isset($_SESSION['usertype'])||$_SESSION['usertype']=="guest"){
?>
            <a href="#" onclick="movetologin()" class="nav-item nav-link " style="color: white;"><?php echo $lang['Login'] ?></a>
            <a href="#" onclick="movetosignup()" class="nav-item nav-link" style="color: white;"><?php echo $lang['Signup'] ?></a>
            <?php
         }

               else if($_SESSION['usertype']=="client"){

         ?>


            <a class="nav-item nav-link "><?php echo $lang['Welcome'] ?> 
        <?php   echo $_SESSION['name']; ?>&nbsp;</a>
            <a href="#" onclick="movetoHome()" class="nav-item nav-link " style="color: white;"><?php echo $lang['home'] ?></a>
            <a href="#" onclick="movetoorders()" class="nav-item nav-link" style="color: white;"><?php echo $lang['My Orders'] ?></a>
            <a href="#" onclick="logout()" class="nav-item nav-link " style="color: white;"><?php echo $lang['Logout'] ?></a>
<?php }

                else if($_SESSION['usertype']=="admin"){ ?>
            <a href="#" onclick="movetoHome()" class="nav-item nav-link " style="color: white;"><?php echo $lang['home'] ?></a>
            <a href="#" onclick="movetoorders()" class="nav-item nav-link" style="color: white;"><?php echo $lang['Client Orders'] ?></a>
            <a href="#" onclick="movetoadminproducts()" class="nav-item nav-link " style="color: white;"><?php echo $lang['Admin Panel'] ?></a>
            <a href="#" onclick="movetoreport()" class="nav-item nav-link " style="color: white;"><?php echo $lang['Generate Report'] ?></a>
            <a href="#" onclick="system()" class="nav-item nav-link" style="color: white;"><?php echo $lang['System Logs'] ?></a>
            <a href="#" onclick="logout()" class="nav-item nav-link " style="color: white;"><?php echo $lang['Logout'] ?></a>
<?php } ?>

        </div>

        
        
    </div>
            <div class="navbar-nav ml-auto">
         

      <a href="#" style="text-decoration: none; " onclick="movetocart()"class="nav-item nav-link fa fa-shopping-cart"  >
       
          <?php echo $lang['cart'] ?>
(<span id="CartCount"></span>)
      </a>
        </div>
</nav>
</div>

<script>
    refreshCart();
    function refreshCart(){
    var products;
if (localStorage.getItem("products") === null) {
    document.getElementById("CartCount").innerHTML="0";
}else{
    var count=0;
 products = localStorage.getItem("products");

products = JSON.parse(products);
    document.getElementById("CartCount").innerHTML=products.length;

    
    
    
    
}}
    
           
            function movetoreport(){
                window.top.location.href = "../public/report.php"; 
            }
            function logout(){
                window.top.location.href = "../public/logout.php"; 
                
            }
             function movetoHome(){
                window.top.location.href = "../public/products.php"; 

            }
            function movetocart(){
                window.top.location.href = "../public/cart.php"; 

            }
             function movetoadminproducts(){
                window.top.location.href = "../public/adminproducts.php"; 

            }
            function movetoorders(){
                window.top.location.href = "../public/orders.php"; 

            }
            function movetologin(){
                window.top.location.href = "../public/login.php"; 

            } function movetosignup(){
                window.top.location.href = "../public/signup.php"; 

            }
             function system(){
                 window.top.location.href = "../other/errormasseges.php"; 
            }
        </script>


