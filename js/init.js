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
}, 5000); // every 5 seconds

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

//Search toggle
$("#search_icon").click(function () {
  $("#index_search").slideToggle(250, "swing");
});

$("#search_icon_mobile").click(function () {
  $("#index_search").toggle();
  $("nav").toggle();
});
$("#back_button_mobile").click(function () {
  $("#index_search").slideToggle(250, "swing");
  $("nav").slideToggle(250, "swing");
});

//add to cart button toggle
$("#add_to_cart").click(function () {
  $(this).text("Added!");
});


//toggle filter menu
$("#filters .title").click(function () {
  $("#filter_body").slideToggle(250, "swing");
});
$("#subcategory").click(function () {
  $("#subcategory_body").slideToggle(250, "swing");
});
$("#price").click(function () {
  $("#price_body").slideToggle(250, "swing");
});
$("#size").click(function () {
  $("#size_body").slideToggle(250, "swing");
});
$("#type").click(function () {
  $("#type_body").slideToggle(250, "swing");
});
$("#fabric").click(function () {
  $("#fabric_body").slideToggle(250, "swing");
});
$("#color").click(function () {
  $("#color_body").slideToggle(250, "swing");
});

//dropdown
var timeout = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open() {
  jsddm_canceltimer();
  jsddm_close();
  ddmenuitem = $(this).find('ul').css('visibility', 'visible');
}

function jsddm_close() {
  if (ddmenuitem) ddmenuitem.css('visibility', 'hidden');
}

function jsddm_timer() {
  closetimer = window.setTimeout(jsddm_close, timeout);
}

function jsddm_canceltimer() {
  if (closetimer) {
    window.clearTimeout(closetimer);
    closetimer = null;
  }
}

$(document).ready(function () {
  $('#hover > li').bind('mouseover', jsddm_open)
  $('#hover > li').bind('mouseout', jsddm_timer)
});

document.onclick = jsddm_close;



//contact

function send_message() {
  jQuery(".field_error").html("");
  var name = jQuery("#name").val();
  var email = jQuery("#email").val();
  var mobile = jQuery("#mobile").val();
  var comment = jQuery("#comment").val();
  var is_error = "";

  if (name == "") {
    jQuery("#name_error").html("Please enter your name");
    is_error = "yes";
  }
  if (email == "") {
    jQuery("#email_error").html("Please enter your email id");
    is_error = "yes";
  }
  if (mobile == "") {
    jQuery("#mobile_error").html("Please enter your mobile number");
    is_error = "yes";
  }
  if (comment == "") {
    jQuery("#comment_error").html("Please enter your message");
    is_error = "yes";
  }

  if (is_error == "") {
    jQuery.ajax({
      url: "send_message.php",
      type: "post",
      data: "name=" +
        name +
        "&email=" +
        email +
        "&mobile=" +
        mobile +
        "&comment=" +
        comment,
      success: function (result) {
        alert(result);
      },
    });
  }
}

function user_register() {
  jQuery(".field_error").html("");
  var name = jQuery("#name").val();
  var email = jQuery("#email").val();
  var mobile = jQuery("#mobile").val();
  var password = jQuery("#password").val();
  var is_error = "";

  if (name == "") {
    jQuery("#name_error").html("Please enter your name");
    is_error = "yes";
  }
  if (email == "") {
    jQuery("#email_error").html("Please enter your email id");
    is_error = "yes";
  }
  if (mobile == "") {
    jQuery("#mobile_error").html("Please enter your mobile number");
    is_error = "yes";
  }
  if (password == "") {
    jQuery("#password_error").html("Please enter your password");
    is_error = "yes";
  }

  if (is_error == "") {
    jQuery.ajax({
      url: "register_submit.php",
      type: "post",
      data: "name=" +
        name +
        "&email=" +
        email +
        "&mobile=" +
        mobile +
        "&password=" +
        password,
      success: function (result) {
        if (result == "wrong") {
          jQuery(".register_msg p").html("Email already registered");
        }
        if (result == "valid") {
          jQuery(".register_msg p").html("Thank You for registering!");
        }
      },
    });
  }
}

function user_login() {
  jQuery(".field_error").html("");
  var email = jQuery("#login_email").val();
  var password = jQuery("#login_password").val();
  var is_error = "";

  if (email == "") {
    jQuery("#login_email_error").html("Please enter your email id");
    is_error = "yes";
  }

  if (password == "") {
    jQuery("#login_password_error").html("Please enter your password");
    is_error = "yes";
  }

  if (is_error == "") {
    jQuery.ajax({
      url: "login_submit.php",
      type: "post",
      data: "email=" + email + "&password=" + password,
      success: function (result) {
        if (result == "wrong") {
          jQuery(".login_msg p").html("Please enter valid login details");
        }
        if (result == "valid") {
          window.location.href = "index.php";
        }
      },
    });
  }
}

function manage_cart(pid, type, price) {
  if (type == "update") {
    var qty = jQuery("#" + pid + "qty").val();
  } else {
    var qty = jQuery("#qty").val();
  }
  jQuery.ajax({
    url: "manage_cart.php",
    type: "post",
    data: "pid=" + pid + "&qty=" + qty + "&type=" + type + "&price=" + price,
    success: function (result) {
      if (type == "update" || type == "remove") {
        location.reload(true);
      }
      jQuery(".htc__qua").html(result);
    },
  });
}

//category mega menu 
$(function () {
  $('.toggle-menu').click(function () {
    $('.exo-menu').toggleClass('display');

  });

});

//image hover zoom
$(document).ready(function () {
  $(".block__pic").imagezoomsl({
    zoomrange: [3, 5]
  });
});




//filter subcategory, category in footer js



//script in footer


//active navbar
$(document).ready(function () {
  $('ul#hover li').on('click', function () {
    var clicked = $(this);
    $('ul#hover li').each(function () {
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
      }
    });
    $(this).addClass('active');
  });
});

function wishlist_manage(pid, type) {
  jQuery.ajax({
    url: 'wishlist_manage.php',
    type: 'post',
    data: 'pid=' + pid + '&type=' + type,
    success: function (result) {
      if (result == 'not_login') {
        window.location.href = 'login.php';
      }
      else if (result == 'remove') {
        M.toast({ html: 'Removed from Wishlist' })

      }
      else {
        M.toast({ html: 'Added to Wishlist' })
      }
    }
  });
}

// PRODUCT SLIDER
