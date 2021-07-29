function checkndup() {
  var name = [];
  $("#pname option").each(function () {
    name.push($(this).val());
  });
  return name;
}
function checkcdup() {
  var color = [];
  $("#pcolor option").each(function () {
    color.push($(this).val());
  });
  return color;
}
function addselection() {
  $("#pcolor").empty();
  $("#pcolor").append(`<option value= "All"> 
          Colors</option>`);
  $(".options").each(function () {
    var val = $(this)
      .text()
      .substr(0, $(this).text().indexOf("-"))
      .replace(" ", "");
    //alert(val2);
    name = checkndup();
    //color = checkcdup();
    if (!name.includes(val)) {
      $("#pname").append(`<option value= "${val}"> 
      ${val}</option>`);
    }
  });
  if ($("#pname").val() != "All") {
    $(".options").each(function () {
      color = checkcdup();
      var val2 = $(this)
        .text()
        .substr($(this).text().indexOf("-") + 1, $(this).text().length - 1)
        .replace(" ", "");
      if ($(this).text() == $("#pname").val() + " - " + val2) {
        if (!color.includes(val2)) {
          $("#pcolor").append(`<option value= "${val2}"> 
          ${val2}</option>`);
        }
      }
    });
  } else {
    $(".options").each(function () {
      color = checkcdup();
      var val2 = $(this)
        .text()
        .substr($(this).text().indexOf("-") + 1, $(this).text().length - 1)
        .replace(" ", "");
      //alert(color);
      if (!color.includes(val2)) {
        $("#pcolor").append(`<option value= "${val2}"> 
          ${val2}</option>`);
      }
    });
  }
}
$(document).ready(function () {
  addselection();
  $("#pname").change(function () {
    addselection();
    var sec = $(this).val();
    var opt = $("#pcolor").val();
    if (opt == "All") opt = $(this).val();
    if (sec != "All") {
      $(".options").each(function () {
        if ($(this).text().includes(sec) && $(this).text().includes(opt)) {
          $(this).parent().parent().css("display", "block");
        } else $(this).parent().parent().css("display", "none");
      });
    } else {
      $(".options").each(function () {
        $(this).parent().parent().css("display", "block");
      });
    }
  });
  $("#pcolor").change(function () {
    var sec = $(this).val();
    var opt = $("#pname").val();
    if (opt == "All") opt = $(this).val();
    if (sec != "All") {
      $(".options").each(function () {
        if ($(this).text().includes(sec) && $(this).text().includes(opt)) {
          $(this).parent().parent().css("display", "block");
        } else $(this).parent().parent().css("display", "none");
      });
    } else {
      if ($("#pname").val() != "All") {
        $(".options").each(function () {
          if ($(this).text().includes(opt))
            $(this).parent().parent().css("display", "block");
          else $(this).parent().parent().css("display", "none");
        });
      } else {
        $(".options").each(function () {
          $(this).parent().parent().css("display", "block");
        });
      }
    }
  });
});
