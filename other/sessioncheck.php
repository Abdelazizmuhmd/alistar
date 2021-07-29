<?php 
session_start();
if(!isset($_SESSION['usertype'])){
     header("location: ../public/logout.php");   
    die();

    
    
}else{
    if($_SESSION['usertype']!="admin" && $_SESSION['usertype']!="client" ){
        header("location: ../public/logout.php");
        die();

    }
}

?>