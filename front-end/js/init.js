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

$("#register_click").click(function () {
  $(".card").addClass("register-card");
});
$("#login_click").click(function () {
  $(".card").removeClass("register-card");
});
