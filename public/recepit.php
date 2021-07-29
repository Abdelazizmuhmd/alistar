<!DOCTYPE html>
<html lang="en">
    <head>
            <link href="../images/lgo.jpeg" rel="icon">
      
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/style.css">
        <title>alistar - Receipt</title>
    </head>
    <body>
        <center>
        <div class="ticket">
            <img src="../images/lgo.jpeg" alt="Logo">
            <p class="centered">RECEIPT 
               
            <table style="margin-left:-100px;table-layout: fixed;" id="receipttable">
                <thead>
                    <tr>
                        <th class="quantity">Quantity</th>
                        <th class="description">product</th>
                        <th class="price">price</th>
                    </tr>
                </thead>
                <tbody>

 

             
                    
                   
                </tbody>
            </table>
            <p class="centered">Thanks for your purchase!
        </div>
        <button id="btnPrint" class="hidden-print">Print</button><br><br><br>
     <button onclick="movetoproducts()" id="continue">Continue shopping</button>

        <script >
if (localStorage.getItem("products") === null) {
    window.location.href="../public/products.php";
}else{
var products = localStorage.getItem("products");
    
products = JSON.parse(products);
    var Total=0;
products.forEach(breakProduct);
    
function breakProduct(item,index){
    Total+=(parseInt(item.price)*parseInt(item.quantity));
    var table =`<tr >
<td style="word-break: break-all;width:10px;" class="quantity">`+item.quantity+`</td>
                        <td style="word-break: break-all;width:10px;"class="description">`+item.name+`/`+item.color+`/`+item.size+`</td>
                        <td style="word-break: break-all;width:10px;"class="price">`+item.price+` L.E</td>
                    </tr>
`;
       document.getElementById('receipttable').insertAdjacentHTML('beforeend', table);

    
}

    Total =Total +30;
    var totaltr=`<tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL include delivery</td>
                        <td class="price">`+Total+` L.E</td>
                    </tr>`;
document.getElementById('receipttable').insertAdjacentHTML('beforeend', totaltr);

} 
  localStorage.removeItem("products");

function movetoproducts(){
                window.location.href="../public/products.php";
            }
            
        
            const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    document.getElementById("continue").style="display:none";
    window.print();
        document.getElementById("continue").style="";

});

</script>
            </center>
    </body>
</html>