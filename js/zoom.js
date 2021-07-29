$(document).ready(function () {
  $(".tile")
    .on("mouseover", function () {
      $(this)
        .children(".photo")
        .css({ transform: "scale(" + $(this).attr("data-scale") + ")" });
    })
    .on("mouseout", function () {
      $(this).children(".photo").css({ transform: "scale(1)" });
    })
    .on("mousemove", function (e) {
      $(this)
        .children(".photo")
        .css({
          "transform-origin":
            ((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
            "% " +
            ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
            "%",
        });
    })
    // tiles set up
   
});
