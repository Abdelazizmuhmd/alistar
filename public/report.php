<?php 
require_once("../model/user.php");
include_once("../other/session.php");
require_once("../model/user.php");


$model2 = new user();
$model2->getMostSell();

$model = new user();
$model->generateReport();
?>


<html>
<head>
        <link href="../images/we.png" rel="icon">
      
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
<style>
    h1{
        color:#3DB8A4;


        font-size: 50px;
          font-family: sans-serif;

    }
svg {
  height: 30%;
}

circle {
  fill: #3DB8A4;
}

text { 
  fill: #fff;
  font-size: 30px;
  font-family: sans-serif;
}
    .a{
        display: inline-block;
    }
    .box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
        margin:auto ;
        
    }
    .box .text{
        position: absolute;
        z-index: 999;
        margin: 5 auto;
        left: 0;
        right: 0;        
        text-align: center;
        top: 40%; /* Adjust this value to move the positioned div up and down */
        background: rgba(0, 0, 0, 0.8);
        font-family: Arial,sans-serif;
        color: #0000FF ;
        width: 60%; /* Set the width of the positioned div */
        
        opacity: 0.8;
        /* #fff; */
    }
</style>  
    <style>
        @media only screen and (max-width: 600px) {
            iframe{
                height:400px;
            }
}
    </style>
</head>
<body>
   
<!--    
<center>
 <iframe  src="../public/header.php" height="100" width="100%" style="border:none;"></iframe>
</center>
    -->
    <?php
    include_once("../public/header.php");
?>
    <center style="margin-top:4%">
        <div class="a">
      <h1> Cost</h1>  
  <svg viewBox="0 0 140 140" preserveAspectRatio="xMinYMin meet">
    <g>
      <circle r="50%" cx="50%" cy="50%" class="circle-back" />
      <text x="50%" y="50%" text-anchor="middle" dy="0.3em"><?php
          
          
          
          echo $model->getreport()->getcost();  ?> L.E</text>
         
    </g>
  </svg>
</div>   
  
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<div class="a">
      <h1> Profit</h1>  
    <svg viewBox="0 0 140 140" preserveAspectRatio="xMinYMin meet">
    <g>
      <circle r="50%" cx="50%" cy="50%" class="circle-back" />
      <text x="50%" y="50%" text-anchor="middle" dy="0.3em"><?php
          
          
          
          echo $model->getreport()->getprofit();  ?> L.E</text>
          
    </g>
  </svg>
 

    </center>
    
            <br>
            <br>
            <br>
            <center><h1> Most Sold</h1> </center>
            <br>
            <br>
            <br>
            <br>
            
    <?php
           $a=$model2->getSell()->getSelled();
          $b=$model2->getSell()->getImage();
         


         ?>
         
         <div style="display:flex; position:relative">
             
         <?php
          for($j=0;$j<3;$j++)
          {
            
            if(empty($a[$j]))
            {
              
            }
            else{
            $imgs_arr = [];
            $imgs_arr=unserialize($b[$j]);
            
           
      
  





  echo"
  <div class='box'>
  <center>
  <img src='{$imgs_arr[0]}grande.jpeg' >
  </center>
  ";
 
  

            

                       
                       
                       echo"<div class='text'>
                       
<h1 style='color:white;'>$a[$j]</h1>
</div>
";}
?>
  
                       </div>
                     
                       
                       <?php
         
           
          }

            
        
          


          ?>
</body>
        

</html>