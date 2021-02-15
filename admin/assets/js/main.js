// $.noConflict();
jQuery(document).ready(function ($) {
    "use strict";
    [].slice
        .call(document.querySelectorAll("select.cs-select"))
        .forEach(function (el) {
            new SelectFx(el);
        });
    jQuery(".selectpicker").selectpicker;
    $(".search-trigger").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(".search-trigger").parent(".header-left").addClass("open");
    });
    $(".search-close").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(".search-trigger").parent(".header-left").removeClass("open");
    });
    $(".equal-height").matchHeight({
        property: "max-height",
    });
    $(".count").each(function () {
        $(this)
            .prop("Counter", 0)
            .animate(
                {
                    Counter: $(this).text(),
                },
                {
                    duration: 3000,
                    easing: "swing",
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    },
                }
            );
    });
    $("#menuToggle").on("click", function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $("body").removeClass("open");
            if (windowWidth < 760) {
                $("#left-panel").slideToggle();
            } else {
                $("#left-panel").toggleClass("open-menu");
            }
        } else {
            $("body").toggleClass("open");
            $("#left-panel").removeClass("open-menu");
        }
    });
    $(".menu-item-has-children.dropdown").each(function () {
        $(this).on("click", function () {
            var $temp_text = $(this).children(".dropdown-toggle").html();
            $(this)
                .children(".sub-menu")
                .prepend('<li class="subtitle">' + $temp_text + "</li>");
        });
    });
    $(window).on("load resize", function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $("body").addClass("small-device");
        } else {
            $("body").removeClass("small-device");
        }
    });

    $("#sid").change(function () {
        var sid = $("#sid").val();
        $.ajax({
            url: 'includes/data.php',
            method: 'post',
            data: 'sid=' + sid,
        }).done(function (cat) {
            console.log(cat);
            cat = JSON.parse(cat);
            $("#sub_cat").empty();
            cat.forEach(function (subcat) {
                $("#sub_cat").append('<option value=' + subcat.id + '>' + subcat.categories + '</option>')
                $('#sub_cat').formSelect()
            })
        });
    });



    var product = [];
    var productDetails = {};
    $("#btnAddColor").click(function () {
        if ($("#color-div input").val() != '') {

            $("#color-div").before('<div style="border: #000 solid 1px; padding:1em;margin:1em 0;"><h4 style = "font-weight:bold" > ' + $("#color-div input").val() + '</h4><br><div class="color_details"><label for="image" class="form-control-label">Add images for  ' + $("#color-div input").val() + '</label><input type="file" name="image" class="form-control"><br><div><h4>Size <span style="margin-left: 40%;">Quantity</span></h4><br><input type="checkbox" name="s" value="s"><label for="s"> Small</label><br><input type="checkbox" name="m" value="m"><label for="m"> Medium</label><br><input type="checkbox" name="l" value="l"><label for="l"> Large</label><br><input type="checkbox" name="xl" value="xl"><label for="xl"> X-Large</label></div><br><button class="done">Done</button></div></div>');

            $('input[type="checkbox"]').click(function () {

                if ($(this).prop("checked") == true) {

                    $(this).next().after('<input style="margin-left:30%" type="text" class="qty" name="qty" placeholder="Enter quantity">')
                    console.log($(this).val() + " is checked.");

                }

                else if ($(this).prop("checked") == false) {
                    $(this).find(".qty").remove();
                    console.log($(this).val() + " is unchecked.");

                }

            });


            $(".done").click(function () {

                //you have to update this object as per checkbox
                productDetails = { color: $("#color-div input").val(), size: $("#size").val(), qty: $("#qty").val() };


                product.push(productDetails);//array of objects
                console.log(product);

                $("#color-div input").val('');//reset color input field
                $(".color_details").remove();//remove color body
                return false;



            })

        }
        else {
            alert("Enter color value");
        }
        return false;
    });
    //ordering and sorting of product master
    function sortTable(f, n) {
        var rows = $('table tbody  tr').get();

        rows.sort(function (a, b) {

            var A = getVal(a);
            var B = getVal(b);

            if (A < B) {
                return -1 * f;
            }
            if (A > B) {
                return 1 * f;
            }
            return 0;
        });

        function getVal(elm) {
            var v = $(elm).children('td').eq(n).text().toUpperCase();
            if ($.isNumeric(v)) {
                v = parseInt(v, 10);
            }
            return v;
        }

        $.each(rows, function (index, row) {
            $('table').children('tbody').append(row);
        });
    }
    var f_sl = 1;
    var f_nm = 1;
    $("#1").click(function () {
        f_sl *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_sl, n);
    });
    $("#2").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#3").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#4").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#5").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#6").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#7").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#8").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#9").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
    $("#10").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });
});
$('#pswdModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

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
        $('#pswdModal').modal('hide');
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
                    $('.helper-text').html("Wrong Current Password")
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