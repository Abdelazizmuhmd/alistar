$(document).ready(function () {
  $("#stat").change(function () {
      if(document.getElementsByClassName("tableshow")[0].rows.length>0){
       document.getElementsByClassName("tableshow")[0].deleteRow(0);}
      
      document.getElementsByClassName("tableshow")[1].style="margin-top:0px";
                  document.getElementsByClassName("tableshow")[1].rows[0].classList.add("must");

    var selected = $("#stat").children("option:selected").attr("value");
    var indx = 0;
    $("#fresh-table")
      .find("tr:eq(" + 0 + ")")
      .find("th")
      .each(function () {
        if ($(this).text() == "Status") indx = $(this).index();
      });
    //$("#Display tr").each(function () {});
    $("#fresh-table tr").each(function () {
      // for every row
      var found = "false";
      var x = $(this).find("td:eq(" + indx + ")"); // search in selected column
      if (
        x.text().toLowerCase().indexOf(selected.toLowerCase()) >= 0 //check if input exist in table
      ) {
        found = "true";
      }

      if (found == "true") {
        // if found show containing row
        $(this).show();

      } else {
        $(this).hide(); // if not hide row
                  document.getElementsByClassName("tableshow")[1].rows[0].classList.add("must");

        $(".must").show();
          
           
          
      }
    });
  });
});
