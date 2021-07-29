<?php
require_once("../database/db.php");
include_once("../other/session.php");

?>
<html>



<head>
    <style>
      body{
        background-image: url("images/wg.jpg");
    }
    </style>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
    <table width="100%" border="1" style="border-collapse:collapse;" class="table table-striped table-dark">
<thead class="thead-dark">
<tr>
<th><strong><center>ID</center></strong></th>
<th><strong><center>Username</center></strong></th>
<th><strong><center>Error Messages</center></strong></th>
<th><strong><center>Error Type</center></strong></th>
<th><strong><center>Error File</center></strong></th>
<th><strong><center>Error Line</center></strong></th>
</tr>
</thead>
<tbody>

<?php
    $db= new Database();
$count=1;
    $db->connect();
$sql="SELECT `firstname`, `errormessage`, `errornumber`, `errorfile`, `errorline` FROM `errorlog` join user on userid = user.id
";
    $db->query($sql);
    $db->execute();
$result = $db->getdata();
foreach($result as $row) { 
    if($row->errornumber==2){?>

<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row->firstname; ?></td>
<td align="center"><?php echo urldecode($row->errormessage); ?></td>
<td align="center"><?php echo ("E-Warning"); ?></td>
<td align="center"><?php echo urldecode($row->errorfile); ?></td>
<td align="center"><?php echo urldecode($row->errorline); ?></td>

</tr>
<?php  }

else if($row->errornumber==512){?>
   <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row->firstname; ?></td>
    <td align="center"><?php echo urldecode($row->errormessage); ?></td>
    <td align="center"><?php echo ("E-User Warning"); ?></td>
    <td align="center"><?php echo urldecode($row->errorfile); ?></td>
    <td align="center"><?php echo urldecode($row->errorline); ?></td>
   
    </tr>


<?php
}
else if($row->errornumber==8){?>
   <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row->firstname; ?></td>
    <td align="center"><?php echo urldecode($row->errormessage); ?></td>
    <td align="center"><?php echo ("E-Notice"); ?></td>
    <td align="center"><?php echo urldecode($row->errorfile); ?></td>
    <td align="center"><?php echo urldecode($row->errorline); ?></td>
    
    </tr>


<?php
}
else if($row->errornumber==256){?>
   <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row->firstname; ?></td>
    <td align="center"><?php echo urldecode($row->errormessage); ?></td>
    <td align="center"><?php echo ("E-User Error"); ?></td>
    <td align="center"><?php echo urldecode($row->errorfile); ?></td>
    <td align="center"><?php echo urldecode($row->errorline); ?></td>
    
    </tr>


<?php
}
else if($row->errornumber==1024){?>
  <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row->firstname; ?></td>
    <td align="center"><?php echo urldecode($row->errormessage); ?></td>
    <td align="center"><?php echo ("E-User Notice"); ?></td>
    <td align="center"><?php echo urldecode($row->errorfile); ?></td>
    <td align="center"><?php echo urldecode($row->errorline); ?></td>
    
    </tr>
    <?php
}
else{?>
   <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row->firstname; ?></td>
    <td align="center"><?php echo urldecode($row->errormessage); ?></td>
    <td align="center"><?php echo ("Other"); ?></td>
    <td align="center"><?php echo urldecode($row->errorfile); ?></td>
    <td align="center"><?php echo urldecode($row->errorline); ?></td>
   
    </tr>
    <?php

}
$count++;
}
?>



</tbody>
</table>

<script>
function myFunction() {
  alert("dleted succes");
}
</script>
</body>

</html>