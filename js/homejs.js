var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style="display:none; width:100%; height:200px;";

  }
    x[slideIndex-1].style="display:block; width:100%; height:200px;";
}


    window.onload = function(){
      $("#pname").val("All");
      $("#pcolor").val("All");
    }
      

    function loadMoreProducts(){
    if(document.getElementById("subcategoryid").value.length==0){
          document.getElementById("loadmore").style.visibility="hidden";
            return false;
           
        }
          
    var subcategoryid = document.getElementById("subcategoryid").value;
    var numRows = document.getElementById("numRows").value;
    $.ajax({
          url: '../other/requestproductsajax.php',
          type: 'POST',
          data: {subcategoryid:subcategoryid,numRows:numRows},
          success: function(response) {
              response=JSON.parse(response);
              
              if(response[0]==""){
                  
               document.getElementById("loadmore").style.visibility="hidden";
               }
          document.getElementById("numRows").value = (parseInt(document.getElementById("numRows").value)+parseInt(response[1]));
           var moreProducts = document.getElementById('products');
            moreProducts.insertAdjacentHTML('beforeend',response[0]);
          
 
            addselection();
            $(".options").each(function () {
            $(this).parent().parent().css("display", "block");
            });
            $('#pname').val('All');
            $('#pcolor').val('All');
          }
        });
    }
    var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
