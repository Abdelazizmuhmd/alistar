<?php
require_once("../view/orders.php");
require_once("../model/user.php");
require_once("../controller/userOrder.php");
include_once("../other/sessioncheck.php");

?>
 <?php
     $model = new user();
     $controller = new userOrderController($model);
    if(isset($_SESSION['id'])){
     $_REQUEST['userid'] = $_SESSION['id'];
    }
     $controller->getuser();
  
     $view = new ordersview($model, $controller);
     if (isset($_GET['action']) && !empty($_GET['action'])) {
         $controller->{$_GET['action']}();
         
         
     }
     
        $controller->getOrders();
     


    ?>

<!DOCTYPE html>
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
     <meta charset="utf-8" />

    <title>
        Orders
    </title>
    
    
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    
    <script src="../js/edit.js"></script>
    <script src="../js/ordertbl.js"></script>
    


  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="../css/fresh-bootstrap-table.css" rel="stylesheet" />
  <link href="../css/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>
  <script src="../js/gsdk-switch.js"></script>
  <script src="../js/demo.js"></script>
    
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="../js/print.js"></script>

    
    <style>
     .selectWrapper{
  border-radius:36px;
  display:inline-block;
  overflow:hidden;
  background:#cccccc;
  border:1px solid #cccccc;
}
.selectBox{
  width:90px;
  height:25px;
  border:0px;
  outline:none;
        padding: 4px;

}
        .bootstrap-table-filter-control-name,.bootstrap-table-filter-control-userid,.bootstrap-table-filter-control-email,.bootstrap-table-filter-control-phone,
        .bootstrap-table-filter-control-email,.bootstrap-table-filter-control-city,.bootstrap-table-filter-control-usertype,.bootstrap-table-filter-control-email
        ,.bootstrap-table-filter-control-orderID,.bootstrap-table-filter-control-status,.bootstrap-table-filter-control-shippingcode{
            background-color: white !important;
            color:black !important;
            border-color:black !important;
            width:auto!important ;
            height:auto!important;
            margin-bottom: 8px;
        }
 

        h1{
            color:#15A0F0;
    line-height: 3.6rem;
    font-weight: bold;
    margin-bottom: 2.4rem;
        }
        
        }




    
    </style>
</head>

<body >
<!--    
<center>
 <iframe  src="../public/header.php" height="100" width="100%" style="border:none;"></iframe>
</center>
    -->
    <?php
    include_once("../public/header.php");
?>
   
       <!--
       <center>
           <label id="slbl" style="color:#28a745; font-size:17px; "> Status:</label>
<br>
           <div class="selectWrapper">
    <select class="selectBox" name="CardiologyPassword" placeholder="Enter Cardiology Password" class="selectpicker" required id="stat">
                    <option value="">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Preparing">Preparing</option>
                    <option value="Finished">Finished</option>
                    <option value="Delivered">Delivered</option>
                </select></div>     
    </center>
    <br>        -->
    <CENTER>
    <h1><?php echo $lang['My Orders'] ?></h1></CENTER>
     <div class="wrapper" style="margin-top:30px;">




  <div class="fresh-table toolbar-color-orange full-screen-table">
  <!--
    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
    Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
  -->
    <table id="fresh-table"  class="table tableshow printa" data-filter-control="true">
        <thead>
    <tr class="must">
                <th data-field="Number" data-sortable="true"><label for="vehicle1">Number</label></th>    

        <?php
                if($_SESSION['usertype']=="admin"){  
                     ?>
        <th data-field="userid" data-sortable="true" data-filter-control="select">userID</th>    
        <th data-field="name" data-sortable="true" data-filter-control="select">Name</th>
        <th data-field="email" data-sortable="true" data-filter-control="select">Email</th>
        <th data-field="phone" data-sortable="true" data-filter-control="select">Phone</th>
        <th data-field="address" data-sortable="true" >Address</th>
        <th data-field="apartment" data-sortable="true">Apartment</th>
        <th data-field="city" data-sortable="true" data-filter-control="select">City</th>
        <th data-field="usertype" data-sortable="true" data-filter-control="select">Usertype</th>
        <?php } ?>
        <th data-field="orderID" data-sortable="true" data-filter-control="select">orderID</th>
        <th data-field="comment" data-sortable="true" >Comment</th>
        <th  data-field="status" data-sortable="true" data-filter-control="select">Status</th>
        <th data-field="createdtime" data-sortable="true">Created time</th>
        
        <th data-field="orderdetails" data-sortable="true">order Details</th>
          <?php
                if($_SESSION['usertype']=="admin"){  
                     ?>
        <th data-field="action" class = 'rm' data-sortable="true">Action</th>
        <th data-field="delete" class = 'rm' data-sortable="true">Delete</th>
  <?php } ?>
        
 </tr>
        </thead>
                      
                <tbody>
                <center>
                <a href="#" class="btn prin btn-info btn-lg">
          <span style="text-align:center" class="glyphicon glyphicon-print"></span> Print
        </a>
                <?php
                 if(count($model->getordersArray())>0)
                  echo $view->output();
                ?>
                </tbody>
        
        
       
        </table>
      
    </div>
        </div>

    
    

<div class="fixed-plugin" style="top: 80px">
  <div class="dropdown open">
    <a href="#" data-toggle="dropdown">
    <i class="fa fa-cog fa-2x"> </i>
    </a>
    <ul class="dropdown-menu">
      <li class="header-title">Adjustments</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Full Background</p>
          <div class="switch"
            data-on-label="ON"
            data-off-label="OFF">
            <input type="checkbox" checked data-target="section-header" data-type="parallax"/>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Colors</p>
          <div class="pull-right">
            <span class="badge filter badge-blue" data-color="blue"></span>
            <span class="badge filter badge-azure" data-color="azure"></span>
            <span class="badge filter badge-green" data-color="green"></span>
            <span class="badge filter badge-orange active" data-color="orange"></span>
            <span class="badge filter badge-red" data-color="red"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
    
    </ul>
  </div>
</div>
    <script>

  var $table = $('#fresh-table')


  $(function () {

    $table.bootstrapTable({
      classes: 'table table-hover table-striped ',
      search: true,
      showRefresh: false,
      showToggle: true,
      showColumns: true,
      pagination: true,
      striped: true,
      sortable: true,
      pageSize: 10,
      pageList: [10, 80, 100],

      formatShowingRows: function (pageFrom, pageTo, totalRows) {
        return ''
      },
      formatRecordsPerPage: function (pageNumber) {
        return pageNumber + ' rows visible'
      }
    })
  

  

  })
         

        
$(document).ready(function () { 


    $('body').on('change','#select_box', function() {
     var orderid = $('option:selected', this).attr('oid');
     var stat = this.value;
        if(stat=="Preparing"){
      $(this).attr("style","color:#DF9420");
        }else if(stat=="Finished"){
                  $(this).attr("style","color:#AF06D5");

        }else if(stat=="Delivered"){
                       $(this).attr("style","color:#F90088");

      }
        else if(stat=="Pending"){
                       $(this).attr("style","color:#15A0F0;");

      }
         
           
                        var orderInde;
                        var statusIndex;
        
           
    $.ajax({
                      url: '../other/updatestatus.php',
                      type: 'POST',
                      data: {orderid:orderid,stat:stat},
                      success: function(response) {

                    if(response==1){
       
                  var table = document.getElementById('fresh-table'), 
                    rows = table.getElementsByTagName('tr'),
                    i, j, cells, customerId; 
                        
                   var rowCheck=document.getElementById("fresh-table").rows[0];
                   var cellsCheck=rowCheck.getElementsByTagName('th');
                for(var k=0;k<cellsCheck.length;k++){
                    var word=cellsCheck[k].getElementsByTagName('div');
                    if(word[0].innerHTML.toLowerCase()=="status"){
                        statusIndex=k;
                    }
                    else  if(word[0].innerHTML.toLowerCase()=="orderid"){
                        orderIndex=k;
                    }
                    
                    
                    
                    
                }        
                    
                                    
                        
                for (i = 0, j = rows.length; i < j; ++i) {
                    cells = rows[i].getElementsByTagName('td');
                    if (!cells.length) {
                        continue;
                    }
                    if(orderid==cells[orderIndex].innerHTML){
                     cells[statusIndex].innerHTML=stat;
                    }
   
                           
                }                        
      
                              
    }else{
        $("#select_box").val('Prepagring');
    }
        
                          
        }
          
        });
        
    });

}); 
        
        
        
</script>


</body>

</html>