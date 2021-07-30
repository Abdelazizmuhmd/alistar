$(document).ready(function () {
$('.prin').click(function(){
   var printme = document.getElementById('fresh-table');

   var wme = window.open("","","width=900,heigh=700");
   wme.document.write(printme.outerHTML);
   wme.document.close();
   wme.focus();
   wme.print();
   wme.close();


});

});