(function ($) {
  $(function () {
    $(".sidenav").sidenav();
    $(".parallax").parallax();
  }); // end of document ready
})(jQuery); // end of jQuery name space

//CAROUSEL
$(document).ready(function () {
  $(".carousel").carousel({
    dist: -10,
    fullWidth: true,
    indicators: true,
  });
});
//CAROUSEL AUTOPLAY
setInterval(function () {
  $(".carousel").carousel("next");
}, 2000); // every 2 seconds

$(document).ready(function () {
  $(".tabs").tabs();
});

//card color swap
$("#register_click").click(function () {
  $(".card").addClass("register-card");
});
$("#login_click").click(function () {
  $(".card").removeClass("register-card");
});

//colored button check box
$(".btn-floating").click(function () {
  if ($(this).find("i").text() == "") {
    $(this).find("i").text("done");
  } else {
    $(this).find("i").text("");
  }
});

//toggle filter menu
$("#price").click(function () {
  $("#price_body").toggle();
});
$("#size").click(function () {
  $("#size_body").toggle();
});
$("#type").click(function () {
  $("#type_body").toggle();
});
$("#fabric").click(function () {
  $("#fabric_body").toggle();
});
