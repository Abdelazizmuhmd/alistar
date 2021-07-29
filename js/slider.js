var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var  val = "";
  //for (var c = 0; c < $(this).find(":selected").text().length / 2; c++)
    var selectorsLength = document.getElementsByClassName("decider").length;
    var selectors = document.getElementsByClassName("decider");
    for(var k=0;k<selectorsLength;k++){
    if(selectors[k].getAttribute("check")=="display:block;"){
       
      val = selectors[k].options[selectors[k].selectedIndex ].value ;

        }
        
    }

   
    
   
    
  var slides = document.getElementsByClassName("mySlides" + val);
  var dots = document.getElementsByClassName("col" + val);
  if (slides.length > 1) {
    if (n > slides.length) {
      slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
  } else {
    slides[0].style.display = "block";
    dots[0].style.display = "none";
    var buttons = document.getElementsByClassName("but" + val);
    for (i = 0; i < buttons.length; i++) buttons[i].style.display = "none";
  }
}
