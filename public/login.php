<?php
include_once( "../model/user.php");
include_once( "../controller/loginController.php");
include_once("../model/menu.php");
include_once("../controller/menuController.php");
include_once("../view/menuView.php");
$model = new menu();
$controller= new menuController($model);
$controller->getAllCategoriesDetails();
$view= new menuView($model,$controller);
$model2 = new user();
$controller2 = new loginController($model2);

if(isset($_GET['action']) && !empty($_GET['action'])){
$controller2->{$_GET['action']}();
if($_GET['action'] == 'login'){
if($model2->getID()!=""){
    header("location:../public/products.php");
}{
echo"<script>window.addEventListener('DOMContentLoaded', function() {wronguser()});
</script>";
}
}
else if ($_GET['action'] == 'forgetPassword'){
echo "mail sent successfully";
}
}

?>
<!doctype html>
<html >
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
<link href="../images/we.png" rel="icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>alistar - login</title>
<link href="../css/home.css" rel="stylesheet" type="text/css" media="all" /> 
<script src="../js/home.js" type="text/javascript"></script>
<script src="../js/login.js" type="text/javascript"></script>
  <link href="../css/footer.css" rel="stylesheet" type="text/css" media="all" /> 


</head>

<body >
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
<div class="grid grid--uniform" role="list">
<main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">     
<div class="grid">
  <div class="grid__item">
    <div class="form--success hide" id="ResetSuccess">
      We've sent you an email with a link to update your password.
    </div>

    <div id="CustomerLoginForm" class="form-vertical">
      <form method="post" action="../public/login.php?action=login" id="customer_login" accept-charset="UTF-8"><input type="hidden" name="form_type" value="customer_login"><input type="hidden" name="utf8" value="✓">

        <h1 class="small--text-center">Login</h1>

        <p id="wronguser" style="color:red;"></p>

        <label for="CustomerEmail" class="label--hidden">Email</label>
        <input type="email" name="email" id="CustomerEmail" class="" placeholder="Email" autocorrect="off" autocapitalize="off" autofocus="" onkeyup="validateForm()">
        <p id="mail" style="color:red;"></p>
        
          <label for="CustomerPassword" class="label--hidden">Password</label>
          <input type="password" value="" name="password" id="CustomerPassword" class="" placeholder="Password" onkeyup="validateForm()">
                 <?php  if(isset($_GET['check'])){ echo"<P> Invalid Passsword </P>";   }
          ?>
          <p id="pass" style="color:red;"></p>
        <p>
          <input type="submit" name="signin" class="btn" value="Log IN" onclick="return validateForm()">
        </p>
        <p><a href="../public/signup.php" id="customer_register_link">Sign up</a></p>
        
          <p><a style = "display:none;" href="#recover" id="RecoverPassword">Forgot your password?</a></p>
        

      </form>
    </div>
<div  id="RecoverPasswordForm" class="hide">
      <h2 class="small--text-center">Reset your password</h2>
      <p>We will send you an email to reset your password.</p>

      <div class="form-vertical">
        <form method="post" action="../public/login.php?action=forgetPassword" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password"><input type="hidden" name="utf8" value="✓">

          <label for="RecoverEmail" class="label--hidden">Email</label>
          <input type="email" value="" name="email" id="recoverEmail" placeholder="Email" autocorrect="off" autocapitalize="off" onkeyup="forgetValidate()">
          <p id="recover" style="color:red;"></p>

          <p>
            <input type="submit" class="btn" value="Submit" onclick="return forgetValidate()">
          </p>

          <button type="button" id="HideRecoverPasswordLink" class="btn--link">Cancel</button>
        </form>
      </div>
</div>
</div>
</div>
</main>
</div>
</main>
</div>
<hr>
</div>  
<script>function wronguser(){document.getElementById('wronguser').innerHTML='Invalid email or password'; } </script>
<?php
include("../public/footer.php");
 ?>
</body>
</html>
