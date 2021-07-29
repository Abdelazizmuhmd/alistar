$(document).ready(function () {
  function popup(head, body) {
    head = head == true ? "Success" : "Failed";
    $(".popup-notification h2").text(head);
    $(".popup-content").html(body);
    $(".modalPopup").css("display", "block");
  }
  $(".popup-close").click(function () {
    $(".modalPopup").css("display", "none");
  });
  var orig;
  var color;
  var error;
  $(document).on("click", ".editor", function () {
    color = $(this).css("background-color");
    $(this).closest("div").attr("contenteditable", "true");
    $(this).focus();
    $(this).addClass("input");
    orig = $(this).text();
    var name = $(this).attr("name");
    /*if (name == "cost" || name == "profit") {
      if ($(this).text().indexOf("L.E")) {
        $(this).html($(this).html().replace(" L.E", ""));
        alert($(this).text());
      }
    }*/
    $(this).keyup(function (e) {
      var test = $(this).text();
      if (/*name == "name" ||*/ name == "color") {
        if (
          !test.match(/^[A-Za-z]+$/) ||
          test.match(/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)
        ) {
          $(this).removeClass("input");
          $(this).addClass("wr");
          error = "Input must include letters only";
        } else {
          $(this).removeClass("wr");
          $(this).addClass("input");
        }
      } else if (name == "name") {
        if (
          test == "" ||
          test.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)
        ) {
          $(this).removeClass("input");
          $(this).addClass("wr");
          error = "Input must include letters only";
        } else {
          $(this).removeClass("wr");
          $(this).addClass("input");
        }
      } else if (name == "description") {
        if (
          test.match(/^[0-9]+$/) ||
          test.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/) ||
          test == ""
        ) {
          $(this).removeClass("input");
          $(this).addClass("wr");
          error = "Input must include letters with numbers if needed";
        } else {
          $(this).removeClass("wr");
          $(this).addClass("input");
        }
      } else if (name == "code") {
        if (
          test.match(/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/) ||
          test == ""
        ) {
          $(this).removeClass("input");
          $(this).addClass("wr");
          error = "Input must include letters or numbers only";
        } else {
          $(this).removeClass("wr");
          $(this).addClass("input");
        }
      } else if (
        name == "profit" ||
        name == "cost" ||
        name == "small" ||
        name == "medium" ||
        name == "large" ||
        name == "xlarge" ||
        name == "xxlarge" ||
        name == "xxxlarge" ||
        name == "weight"
      ) {
        if (!test.match(/^[0-9]+$/)) {
          $(this).removeClass("input");
          $(this).addClass("wr");
          error = "Input must include numbers only";
        } else {
          $(this).removeClass("wr");
          $(this).addClass("input");
        }
      }
    });
  });
  $(document).on("focusout", ".editor", function (event) {
    cell = $(this);
    var row = $(this).closest("tr");
    var product = new FormData();
    var rowIndex = row.index();
    var id,
      pid,
      ni,
      csi,
      pi,
      ci,
      di,
      coi,
      si,
      mi,
      li,
      xli,
      xxli,
      xxxli,
      wi = 0;
    $("#productstable")
      .find("tr:eq(" + 0 + ")")
      .find("th")
      .each(function () {
        if ($(this).text() == "id") id = $(this).index();
        else if ($(this).text() == "detailId") pid = $(this).index();
        else if ($(this).text() == "name") ni = $(this).index();
        else if ($(this).text() == "cost") csi = $(this).index();
        else if ($(this).text() == "profit") pi = $(this).index();
        else if ($(this).text() == "code") ci = $(this).index();
        else if ($(this).text() == "description") di = $(this).index();
        else if ($(this).text() == "color") coi = $(this).index();
        else if ($(this).text() == "SQ") si = $(this).index();
        else if ($(this).text() == "MQ") mi = $(this).index();
        else if ($(this).text() == "LQ") li = $(this).index();
        else if ($(this).text() == "XLQ") xli = $(this).index();
        else if ($(this).text() == "XXLQ") xxli = $(this).index();
        else if ($(this).text() == "XXXLQ") xxxli = $(this).index();
        else if ($(this).text() == "Weight") wi = $(this).index();
      });
    var productid = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + id + ")");
    product.append("productid", productid.text());
    var productdetailid = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + pid + ")");
    product.append("productdetailid", productdetailid.text());
    var pname = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + ni + ")");
    product.append("name", pname.text());
    var cost = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + csi + ")");
    product.append("cost", cost.text().replace("L.E", ""));
    var profit = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + pi + ")");
    product.append("profit", profit.text().replace("L.E", ""));
    var code = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + ci + ")");
    product.append("code", code.text());
    var description = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + di + ")");
    product.append("description", description.text());
    var color = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + coi + ")");
    product.append("color", color.text());
    var s = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + si + ")");
    product.append("s", s.text());
    var m = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + mi + ")");
    product.append("m", m.text());
    var l = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + li + ")");
    product.append("l", l.text());
    var xl = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + xli + ")");
    product.append("xl", xl.text());
    var xxl = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + xxli + ")");
    product.append("xxl", xxl.text());
    var xxxl = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + xxxli + ")");
    product.append("xxxl", xxxl.text());
    var weight = $("#productst")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(" + wi + ")");
    product.append("weight", weight.text());
    product.append("imageurls", "");
    var noti = $(this).attr("name");
    //var dupcolor = false;
    var dcount = 0;
    if ($(this).attr("name") == "color") {
      var ccell = $(this);
      $("#productst")
        .find("tr")
        .each(function () {
          if (
            $(this)
              .find("td:eq(" + id + ")")
              .text() == productid.text()
          ) {
            if (
              $(this)
                .find("td:eq(" + coi + ")")
                .text() == color.text()
            )
              dcount++;
          }
        });
    }
    if ($(this).attr("class").includes("wr")) {
      popup(false, "Invalid " + $(this).attr("name") + ", " + error);
      $(this).removeClass("wr");
      $(this).text(orig);
    }
    //alert("Invalid " + $(this).attr("name"));
    else if (dcount > 1) {
      popup(
        false,
        "Invalid " + $(this).attr("name") + ", cannot insert color twice"
      );
      $(this).removeClass("input");
      $(this).text(orig);
    } else {
      $.ajax({
        url: "../public/adminproducts.php?action=updateProduct",
        type: "POST",
        data: product,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.includes("SORRY BAD REQUEST , TRY AGAIN")) {
            popup(false, "Invalid " + noti);
            cell.removeClass("input");
            cell.html("<div>" + orig + "</div>");
          } else {
            cell.removeClass("input");
            cell.html("<div>" + cell.text() + "</div>");
            popup(true, noti + " Updated!");
            $("#productst")
              .find("tr")
              .each(function () {
                if (
                  $(this)
                    .find("td:eq(" + id + ")")
                    .text() == productid.text()
                ) {
                  $(this)
                    .find("td:eq(" + ni + ")")
                    .html(
                      "<div name ='name' class = 'editor'>" +
                        pname.text() +
                        "</div>"
                    );
                  $(this)
                    .find("td:eq(" + ci + ")")
                    .html(
                      "<div name ='code' class = 'editor'>" +
                        code.text() +
                        "</div>"
                    );
                  $(this)
                    .find("td:eq(" + csi + ")")
                    .html(
                      "<div name ='cost' class = 'editor'>" +
                        cost.text().replace("L.E", "") +
                        "</div>L.E"
                    );
                  $(this)
                    .find("td:eq(" + pi + ")")
                    .html(
                      "<div name ='profit' class = 'editor'>" +
                        profit.text().replace("L.E", "") +
                        "</div>L.E"
                    );
                  $(this)
                    .find("td:eq(" + di + ")")
                    .html(
                      "<div name ='description' class = 'editor'>" +
                        description.text() +
                        "</div>"
                    );
                  $(this)
                    .find("td:eq(" + wi + ")")
                    .html(
                      "<div name ='weight' class = 'editor'>" +
                        weight.text() +
                        "</div>"
                    );
                }
              });
          }
        },
      });
    }
  });
});
