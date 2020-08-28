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
      data:
        "name=" +
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
      data:
        "name=" +
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

function manage_cart(pid, type) {
  if (type == "update") {
    var qty = jQuery("#" + pid + "qty").val();
  } else {
    var qty = jQuery("#qty").val();
  }
  jQuery.ajax({
    url: "manage_cart.php",
    type: "post",
    data: "pid=" + pid + "&qty=" + qty + "&type=" + type,
    success: function (result) {
      if (type == "update" || type == "remove") {
        window.location.href = "cart.php";
      }
      jQuery(".htc__qua").html(result);
    },
  });
}
