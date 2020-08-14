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


var myCenter = new google.maps.LatLng(51.308742, -0.32085);
function initialize() {
  var mapProp = {
    center: myCenter,
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };
  var map = new google.maps.Map(document.getElementById("map"), mapProp);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}
google.maps.event.addDomListener(window, "load", initialize);
