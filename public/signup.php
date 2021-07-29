<?php
require_once( "../model/user.php");
require_once( "../controller/signUpController.php");
require_once("../model/menu.php");
require_once("../controller/menuController.php");
require_once("../view/menuView.php");
$model = new menu();
$controller= new menuController($model);
$controller->getAllCategoriesDetails();
$view= new menuView($model,$controller);
$model2 = new user();
$controller2 = new signUpController($model2);
 if (isset($_GET['action']) && !empty($_GET['action'])){
  $controller2->{$_GET['action']}();
    header("location:../public/login.php");
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
<title>alistar - Signup</title>
<link rel="stylesheet" media="all" href="../css/home.css" />  
<script src="../js/signUp.js" type="text/javascript" ></script> 
  <link href="../css/footer.css" rel="stylesheet" type="text/css" media="all" /> 

<script src="../js/home.js" type="text/javascript"></script>
</head> 
<body>
<?php
    include_once("../public/header.php");
?>
<div> 
<div class="site-wrapper">
<div class="grid">
<img src="../images/we.png" style="margin-bottom:30px; margin-left:60px; width:120px;height:120px;">
<?php
include("menu.php");
?>   
<main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">
<hr class="hr--border-top small--hide">
<h1 class="small--text-center">Create Account</h1>
<div class="form-register form-vertical">
   <form method = "post" action="../public/signup.php?action=signUP" >
    <label for="FirstName" class="label--hidden">First Name</label>
    <input type="text" name="firstname" id="firstName"  placeholder="First Name" autocapitalize="words" autofocus="" maxlength="10" onkeyup="validateForm()">
    <p id="Fname" style="color:red;"></p>
    <label for="LastName" class="label--hidden">Last Name</label>
    <input type="text" name="lastname" id="lastName"  placeholder="Last Name" autocapitalize="words" maxlength="10" onkeyup="validateForm()">
    <p id="Lname" style="color:red;"></p>

    <label for="Email" class="label--hidden">Email</label>
    <input type="email" name="email" id="email"  class="" placeholder="Email" autocorrect="off" autocapitalize="off" onkeyup="validateForm()">
    <p id="mail" style="color:red;"></p>

    <label for="CreatePassword" class="label--hidden">Password</label>
    <input type="password" name="password" id="password"  class="" placeholder="Password" maxlength="25" onkeyup="validateForm()">
    <p id="pass" style="color:red;"></p>
    <p>
      <input type="submit" name="submit" class="btn" value="Create" onclick="return validateForm()" >
    </p>
  </form> 
  
</div>
</main>
</div>
<hr>
</div>  
</div>
<script src="../js/signupjs.js" type="text/javascript"></script>
<?php
include("../public/footer.php");
 ?>
</body>
</html>
