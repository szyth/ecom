$.noConflict();
jQuery(document).ready(function ($) {
    "use strict";



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
