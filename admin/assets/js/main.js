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
});
