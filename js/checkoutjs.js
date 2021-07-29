if (localStorage.getItem("products") === null) {
window.location.href="https://bat-store.com/store/public/products.php";
}else{
var products = localStorage.getItem("products");
    
products = JSON.parse(products);
    var total=0;
    var subtotal=0;
    var productscheckout=``;
products.forEach(breakProduct);
function breakProduct(item,index){
total+=(parseInt(item.price)*parseInt(item.quantity));
subtotal+=(parseInt(item.price)*parseInt(item.quantity));
var tableoutput=`<table class='product-table'>
      <caption class='visually-hidden'>Shopping cart</caption>
      <thead class='product-table__header'>
        <tr>
          <th scope='col'><span class='visually-hidden'>Product image</span></th>
          <th scope='col'><span class='visually-hidden'>Description</span></th>
          <th scope='col'><span class='visually-hidden'>Quantity</span></th>
          <th scope='col'><span class='visually-hidden'>Price</span></th>
        </tr>
      </thead>

<tbody data-order-summary-section='line-items'>
      
<tr class='product' data-product-id='4396731957282' data-variant-id='31415765139490' data-product-type='Sweater' data-customer-ready-visible>
<td class='product__image'>
    <div class='product-thumbnail' style='margin-bottom:5px;'>
  <div class='product-thumbnail__wrapper'>
    <img alt=''class='product-thumbnail__image' src='`+item.img+`small.jpeg' />
  </div>
    <span class='product-thumbnail__quantity' aria-hidden='true'>`+item.quantity+`</span>
</div>

          </td>
          <th class='product__description' scope='row'>
            <span class='product__description__name order-summary__emphasis'>`+item.name+` </span>
            <span class='product__description__variant order-summary__small-text'>`+item.color+`/`+item.size+`</span>


          </th>
          <td class='product__quantity visually-hidden'>
            1
          </td>
          <td class='product__price'>
            <span class='order-summary__emphasis'>`+(parseInt(item.price)*parseInt(item.quantity))+`L.E</span>
          </td>
        </tr>

      </tbody>
    </table>`;   
   document.getElementById('tableoutput').insertAdjacentHTML('beforeend', tableoutput);
   
     productscheckout +=`
    <input type='text' form='myform' name='producta[`+index+`][id]' value='`+item.id+`' hidden>
    <input type='text' form='myform' name='producta[`+index+`][size]' value='`+item.size+`' hidden>
    <input type='text' form='myform' name='producta[`+index+`][quantity]' value='`+item.quantity+`' hidden>

`;
    
 
}
     document.getElementById('Totalprice').innerHTML=total+30+" L.E";
        
    document.getElementById('subtotalprice').innerHTML=subtotal+" L.E";

           document.getElementById('productsCheckOut').innerHTML =productscheckout;

}
        
       