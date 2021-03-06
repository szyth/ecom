

// PRODUCT QUANTITY INCREMENT/DECREMENT 

$('#qty').change(function () {
  var qty = Number($('#qty').val());
  var available = Number($('#available')[0].innerHTML);

  if (qty < 1)
    $('#qty').val(1);
  if (qty > available)
    $('#qty').val(available);
});


$('#increment').click(function () {
  var counter = Number($('#qty').val());
  var available = Number($('#available')[0].innerHTML);

  if (counter < available) {
    counter++;
    $('#qty').val(counter);
  }


});
$('#decrement').click(function () {
  var counter = Number($('#qty').val());
  if (counter > 1) {
    counter--;
    $('#qty').val(counter);
  }

});
// PRODUCT QUANTITY INCREMENT/DECREMENT - END

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
          // jQuery(".register_msg p").html("Thank You for registering!");
          window.location.href = "checkout.php";
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
      } else if (result == 'remove') {
        location.reload();
        M.toast({
          html: 'Removed from Wishlist'
        })
      } else {
        M.toast({
          html: 'Added to Wishlist'
        })
      }
    }
  });
}

// Address Accordian
$(document).ready(function () {
  $('.collapsible').collapsible();

  //Address Modal
  $('.modal').modal();
  $('input#name').characterCounter();

  if ($('.addressList')) {
    populateAddress();
  }
  if ($('.addressListRadio')) {
    populateAddressinRadio();

  }
  //address remove
  $(document).on('click', '.address_remove', function () {
    if (confirm('Are you sure you want to delete this address?')) {
      var address_id = $(this).closest('.collapsible-header').attr('data-sg-aid');
      $.ajax({
        url: 'address_manage.php',
        type: 'post',
        data: 'aid=' + address_id,
        success: function (result) {
          if (result == 'remove') {
            location.reload();
          }
        }
      });
    }
  });

});



var populateAddress = function () {
  $.ajax({
    url: 'includes/get_api.php',
    method: 'post',
    data: {
      "target": 'address'
    },
  }).done(function (response) {
    // console.log(response);
    response = JSON.parse(response);
    if (response && response.length) {
      $.each(response, function (index, item) {
        // console.log(item);
        $('.addressList ul.collapsible').append(`<li> <div class="collapsible-header" style="position:relative;" data-sg-aid="${item.id}"><i class="material-icons-outlined">fiber_manual_record</i>${item.name} <a class="address_remove right"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div> <div class="collapsible-body"> <span> <p>${item.mobile}</p> <p>${item.address}</p> <p>${item.pincode}</p> <p>${item.city}</p> </span> </div></li>`);
      })
    }
    else {
      $('.addressList').append(`<p class="center">You have No Saved Addresses</p>`);
    }

  });
};

var populateAddressinRadio = function () {
  $.ajax({
    url: 'includes/get_api.php',
    method: 'post',
    data: {
      "target": "addressRadio"
    },
  }).done(function (response) {
    response = JSON.parse(response);
    if (response && response.length) {
      $.each(response, function (index, item) {
        $('.addressListRadio').append(`<p> <label> <input data-sg-aid="${item.id}" name="group1" type="radio" /> <span style="line-height: 1.4rem;">${item.name}<br>${item.mobile}<br>${item.address}<br>${item.pincode}<br>${item.city}</span> </label> </p> <div class="divider"></div>`);
      })
    }
    else {
      $('.addressListRadio').append(`<br><p>You have No Saved Addresses</p>`);
    }
  })
}


//checkout order
$(document).ready(function () {
  $('#address_form_submit #submit').click(function () {
    var address_id = $('.addressListRadio input[name=group1]:checked').attr('data-sg-aid');
    var payment_type = $('#payment_mode input[name=group2]:checked').attr('data-value');

    if (address_id) {
      if (payment_type == 'cod') {
        $.ajax({
          url: 'order_manage.php',
          method: 'post',
          data: {
            "address_id": address_id,
            "payment_type": payment_type
          },
        }).done(function (response) {
          document.location.href = 'thankyou.php', true;
        });
      }
      if (payment_type == 'online') {
        rzp1.open();
      }
    } else {
      alert("Please select an Address!");
    }


  })
});
var options = {
  "key": "rzp_test_z9RWfE5BZTr1Ie", // Enter the Key ID generated from the Dashboard
  "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
  "currency": "INR",
  "name": "Classi Closet",
  "description": "Test Transaction",
  "image": "https://example.com/your_logo",
  "handler": function () {
    alert("Success");
    document.location.href = 'thankyou.php', true;

  },
  "prefill": {
    "name": "Gaurav Kumar",
    "email": "gaurav.kumar@example.com",
    "contact": "9999999999"
  },
  "notes": {
    "address": "Razorpay Corporate Office"
  },
  "theme": {
    "color": "#3399cc"
  }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response) {
  alert(response.error.code);
  alert(response.error.description);
  alert(response.error.source);
  alert(response.error.step);
  alert(response.error.reason);
  alert(response.error.metadata.order_id);
  alert(response.error.metadata.payment_id);
});

// PRODUCT SLIDER 
$(document).ready(function () {
  $(".tb").hover(function () {
    $(".tb").removeClass("tb-active");
    $(this).addClass("tb-active");

    current_fs = $(".active");

    next_fs = $(this).attr("id");
    next_fs = "#" + next_fs + "1";

    $("fieldset").removeClass("active");
    $(next_fs).addClass("active");

    current_fs.animate({}, {
      step: function () {
        current_fs.css({
          display: "none",
          position: "relative",
        });
        next_fs.css({
          display: "block",
        });
      },
    });
  });
});
// PRODUCT SLIDER - END

//PASSWORD CHANGE
$("#pswd").click(function () {
  var oldpass = $('#oldpass').val();
  var newpass = $('#newpass').val();
  var cnewpass = $('#cnewpass').val();
  var oldpassDB = '';
  function ajaxpswdChange() {
    $.ajax({
      url: 'includes/post_user_pass.php',
      method: 'post',
      data: {
        'newpass': newpass,
        'cnewpass': cnewpass
      },
      success: function (response) {
        alert(response);
      }
    })
    $('#pswdModal').modal('close');
  }
  if (oldpass == '' || newpass == '' || cnewpass == '') {
    $('.helper-text').html("Please fill all fields!");
  }

  else {
    $.ajax({
      url: 'includes/get_user_pass.php',
      method: 'post',
      data: {
        'oldpass': oldpass
      },
      success: function (response) {
        oldpassDB = response;
        if (oldpass == oldpassDB) {
          if (newpass == cnewpass) {
            ajaxpswdChange();
          }
          else {
            $('.helper-text').html("Confirmation Password didn't match")
          }

        }
        else {
          $('.helper-text').html("Current Password is Incorrect")
        }
      }
    })
  }
})
$(document).ready(function () {
  $('#show').click(function () {
    $(this).is(':checked') ? $('#oldpass').attr('type', 'text') : $('#oldpass').attr('type', 'password');
    $(this).is(':checked') ? $('#newpass').attr('type', 'text') : $('#newpass').attr('type', 'password');
    $(this).is(':checked') ? $('#cnewpass').attr('type', 'text') : $('#cnewpass').attr('type', 'password');
  });
});

// LOAD MORE BUTTON 
$(document).ready(function () {
  $('#all_product_button').click(function () {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    var productperpage = 8;
    row = row + productperpage;

    if (row <= allcount) {
      $("#row").val(row);

      $.ajax({
        url: 'loadMore.php',
        type: 'post',
        data: { row: row },
        beforeSend: function () {
          $("#all_product_button").text("Loading...");
        },
        success: function (response) {
          response = JSON.parse(response);
          // Setting little delay while displaying new content
          setTimeout(function () {
            // appending posts after last post with class="post"
            // $(".product_container:last").after(response).show().fadeIn("slow");
            // console.log(response);
            $.each(response, function (index, item) {
              if (item.discount_type == "rate") {
                item.price = item.mrp - item.discount;
                $('.product_container').append(` <div class="col s6 m4 l3 product_container_inner"> <div class="dress-card box_shadow center"> <a href="product.php?id=${item.id}" class="black-text"> <div class="dress-card-head"> <img class="dress-card-img-top" src="media/product/${item.image}" alt=""> </div> <div class="dress-card-body"> <h4 class="dress-card-title"> ${item.name}</h4> <p class="dress-card-para"><span class="dress-card-crossed ">Rs. ${item.mrp}</span> &ensp; <span class="dress-card-price ">Rs. ${item.price}</span><a href="javascript:void(0)" onclick="wishlist_manage('${item.id}','add')" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i> </a> </p> </div> </a> </div> </div>`);
              }
              else if (item.discount_type == "percent") {
                item.price = (item.mrp - ((item.discount * item.mrp) / 100));
                $('.product_container').append(` <div class="col s6 m4 l3 product_container_inner"> <div class="dress-card box_shadow center"> <a href="product.php?id=${item.id}" class="black-text"> <div class="dress-card-head"> <img class="dress-card-img-top" src="media/product/${item.image}" alt=""> </div> <div class="dress-card-body"> <h4 class="dress-card-title"> ${item.name}</h4> <p class="dress-card-para"><span class="dress-card-crossed ">Rs. ${item.mrp}</span> &ensp; <span class="dress-card-price ">Rs. ${item.price}</span><a href="javascript:void(0)" onclick="wishlist_manage('${item.id}','add')" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i> </a> </p> </div> </a> </div> </div>`);
              }
              else {
                $('.product_container').append(` <div class="col s6 m4 l3 product_container_inner"> <div class="dress-card box_shadow center"> <a href="product.php?id=${item.id}" class="black-text"> <div class="dress-card-head"> <img class="dress-card-img-top" src="media/product/${item.image}" alt=""> </div> <div class="dress-card-body"> <h4 class="dress-card-title"> ${item.name}</h4> <p class="dress-card-para"><span class="dress-card-price ">Rs. ${item.mrp}</span><a href="javascript:void(0)" onclick="wishlist_manage('${item.id}','add')" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i> </a> </p> </div> </a> </div> </div>`);
              }

            })


            var rowno = row + productperpage;

            // checking row value is greater than allcount or not
            if (rowno > allcount) {

              // Change the text and background
              $('.loadMOre').append(`<h5>That's all Folks!</h5>`);
              $('#all_product_button').remove();
              // $('#all_product_button').css({ "background-color": "darkorchid", "color": "white", "cursor": "not-allowed" });
              // $('#all_product_button').removeAttr("id");
            } else {
              $("#all_product_button").text("Load more");
            }
          }, 2000);

        }
      });
    } else {
      $('#all_product_button').text("Loading...");

      // Setting little delay while removing contents
      setTimeout(function () {

        // When row is greater than allcount then remove all class='product_container' element after 3 element
        $('.product_container:nth-child(8)').nextAll('.product_container').remove();

        // Reset the value of row
        $("#row").val(0);

        // Change the text and background
        $('#all_product_button').text("Load more");
        $('#all_product_button').css("background", "#15a9ce");

      }, 2000);


    }
  });
});
