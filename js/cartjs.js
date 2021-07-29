var products;
if (localStorage.getItem("products") === null) {
}else{
 products = localStorage.getItem("products");
    
products = JSON.parse(products);
    var subtotal=0;
products.forEach(breakProduct);
    
function breakProduct(item,index){
    subtotal+=(parseInt(item.price)*parseInt(item.quantity));
    var table=`
    <table class='cart-table responsive-table table--no-border' >
          <thead class='cart__row cart__header-labels small--hide'>

            <tr><th class='text-left cart__table-cell--image'></th>
            <th class='text-center cart__table-cell--meta'></th>
            <th class='text-right cart__table-cell--price'>Price</th>
            <th class='text-right cart__table-cell--quantity'>Quantity</th>
            <th class='text-right cart__table-cell--line-price'>Total</th>
          </tr></thead>
          <tbody>
            
      <tr class='cart__row responsive-table__row'>
      <td class='cart__table-cell--image small--text-center'>
                  


                    <div id='CartImageWrapper--13760170131490' class='cart__image-wrapper supports-js' style='max-width:165px; max-height:220px; '>
                      <a class='cart__image-container' href=../public/product.php?action=readOneProduct&productid=`+item.productid+`&productdetailid=`+item.id+` style='padding-top:100.0%;max-width:165px; max-height:220px;'>
                        <img id='CartImage--13760170131490' style='max-width:165px; max-height:220px; ' class='cart__image' src='`+item.img+`large.jpeg'  itemprop='image'>
                      </a>
                    </div>
                </td>
                <td class='cart__table-cell--meta text-center large-up--text-left'>
                  <p>
                    <a href=''>`+item.name+`</a>
                      <br><small>`+item.color+`/`+item.size+`</small>
                    </p><div class='hulkapps-reminder'></div>
                  <p></p>

                  <p class='txt--minor'>

                    <a class='cart__remove'style='color:red;' href=""  onclick=remove(`+index+`);>Remove</a>
                  </p>
                </td>
                <td class='cart__table-cell--price medium-up--text-right' data-label='Price'><span class='hulkapps-cart-item-price' > `+item.price +` L.E </span>
</td>
                <td data-label='Quantity' class='medium-up--text-right cart__table-cell--quantity'>
                  <span class='hulkapps-cart-item-line-price' >`+item.quantity+` </span></td>


                <td data-label='Total' class='text-right cart__table-cell--line-price'><span class='hulkapps-cart-item-line-price'   >`+(parseInt(item.price)*parseInt(item.quantity))+` L.E</span></td>
              </tr>
              <hr style='margin-bottom:30px;'>             
              

          </tbody>
        </table>`;
   document.getElementById('carttables').insertAdjacentHTML('beforeend', table);
document.getElementById("subtotalprice").innerHTML=subtotal+" L.E";
    
}
    
    
}

        function remove(index){
            products.splice(index, 1);
            localStorage.clear();
           products= JSON.stringify(products)
            localStorage.setItem("products",products);

        }
        