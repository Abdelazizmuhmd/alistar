
function changeImage(index, col) {
    var img = document.createElement("img");
    img.src = document.getElementById("sel" + col + index).src;
    img.className = "product-single__photo "+col+"1";
    src = document.getElementById("displayPic" + col);
    src.setAttribute("src", img.src);
    src.innerHTML = "";
    src.appendChild(img);
    $(".tile").each(function () {
      $(this)
        // add a photo container
        .append('<div class="photo"></div>')
        // some text just to show zoom level on current item in this example
        .append('<div class="txt"><div class="x">' + "</div><br></div>")
        // set up a background image for each tile based on data-image attribute
        .children(".photo")
        .css({ "background-image": "url(" + $(this).attr("src") + ")" });
    });
  }

   function addToCart(counterid) {
     
            var productid=document.getElementById("productid").value//productid
            var id = document.getElementById("product_id"+counterid).value;//product detailid
      
            var name = document.getElementById("product_name").value;// get product name
            var price = document.getElementById("product_cost").value;  // get quantity
            var img= document.getElementById("product_img"+counterid).value;
            var color=document.getElementById("ProductSelect-product-color-option-"+counterid).value;
            var size=document.getElementById("ProductSelect-product-size-option-"+counterid).value;
            var quantity=document.getElementById("Quantity"+counterid).value;
            var maxQuantity=document.getElementById("Quantity"+counterid).getAttribute("max");
            var minQuantity=document.getElementById("Quantity"+counterid).getAttribute("min");

       if(parseInt(quantity)>parseInt(maxQuantity)){
           alert("max quantity is: "+maxQuantity);
           return true;
           
       }
       else if(parseInt(quantity)<parseInt(minQuantity)){
        alert("min quantity is: "+maxQuantity);
           return true;
       }
       
            var flag = 0 ;
            var data = [];
if (localStorage.getItem("products") === null) {
}else{
var products = localStorage.getItem("products");
    
products = JSON.parse(products);
    
products.forEach(breakProduct);
    
function breakProduct(item,index){
  if(item.id==id&&item.size==size){
      if(parseInt(maxQuantity)>=parseInt(parseInt(quantity)+parseInt(item.quantity))){
          
      item.quantity = parseInt(item.quantity)+parseInt(quantity);
          
      flag=1;
          
      }else{
          
          alert("maximum quantity of this item is: "+maxQuantity+", You already have: "+item.quantity+" in cart");
          flag=2;
      }
  }
    if(flag!=2){
  data.push(item);
    }
}
}  
    if(flag!=2){
if(flag==0){
var feed = {"id":id,"name":name,"price":price,"img":img,"color":color,"size":size,"quantity":quantity,"productid":productid};
data.push(feed);
}
final_data=JSON.stringify(data);

localStorage.setItem("products", final_data);
            refreshCart();

window.location.href="../public/cart.php";
       }
        
   }    