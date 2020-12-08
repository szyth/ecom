// $.noConflict();
jQuery(document).ready(function ($) {
    "use strict";

    // var product = [];
    // var productDetails = {};
    // $("#btnAddColor").click(function () {
    //     if ($("#color-div input").val() != '') {

    //         $("#color-div").before('<div style="border: #000 solid 1px; padding:1em;margin:1em 0;"><h4 style = "font-weight:bold" > ' + $("#color-div input").val() + '</h4><br><div class="color_details"><label for="image" class="form-control-label">Add images for  ' + $("#color-div input").val() + '</label><input type="file" name="image" class="form-control"><br><div><h4>Size <span style="margin-left: 40%;">Quantity</span></h4><br><input type="checkbox" name="s" value="s"><label for="s"> Small</label><br><input type="checkbox" name="m" value="m"><label for="m"> Medium</label><br><input type="checkbox" name="l" value="l"><label for="l"> Large</label><br><input type="checkbox" name="xl" value="xl"><label for="xl"> X-Large</label></div><br><button class="done">Done</button></div></div>');

    //         $('input[type="checkbox"]').click(function () {

    //             if ($(this).prop("checked") == true) {

    //                 $(this).next().after('<input style="margin-left:30%" type="text" class="qty" name="qty" placeholder="Enter quantity">')
    //                 console.log($(this).val() + " is checked.");

    //             }

    //             else if ($(this).prop("checked") == false) {
    //                 $(this).find(".qty").remove();
    //                 console.log($(this).val() + " is unchecked.");

    //             }

    //         });


    //         $(".done").click(function () {

    //             //you have to update this object as per checkbox
    //             productDetails = { color: $("#color-div input").val(), size: $("#size").val(), qty: $("#qty").val() };


    //             product.push(productDetails);//array of objects
    //             console.log(product);

    //             $("#color-div input").val('');//reset color input field
    //             $(".color_details").remove();//remove color body
    //             return false;



    //         })

    //     }
    //     else {
    //         alert("Enter color value");
    //     }
    //     return false;
    // });

    // Version 2

    // $('.product-card #p-add-color').on('click', function (evt) {
    //     var $target = evt.currentTarget;
    //     var parent = $target.closest('.product-card');
    //     var inputs = parent.getElementsByClassName('input-field');
    //     var valid = true;

    //     $.each(inputs, function (index, input) {
    //         if (input.firstElementChild.classList.contains('invalid') || (input.firstElementChild && !input.firstElementChild.innerHTML.length > 0)) {
    //             valid = false;
    //         }
    //     });

    //     if (valid) {
    //         alert("lol");
    //     }

    //     // debugger;

    // })

    var product = {
        name: "",
        description: ""
    };
    var colors = [];


    $('form.product-card').submit(function (e) {
        var inputs = $('form.product-card').find('.input-field input, .input-field textarea');
        var valid = true;
        $.each(inputs, function (index, input) {
            if (!input.value && !input.value.trim().length > 0) {
                input.parentNode.getElementsByTagName('span').item(0).setAttribute('data-error', 'This field is required')
                input.classList.add('invalid')
                valid = false;
            }
        })

        if (valid) {
            var color = $('#p_color').val().trim();
            if (colors.find(element => element === color)) {
                $('#p_color').parent().find('span').attr('data-error', 'Color already exists');
                $('#p_color').addClass('invalid');
            } else {
                $('#p_color').val("");
                colors.push(color);
                renderVariant(color);
            }
            e.preventDefault();
        }
        else
            e.preventDefault();
    })

    $(document).on('change', 'input[type=checkbox]', function (e) {
        if (e.currentTarget.checked) {
            e.currentTarget.parentNode.nextElementSibling.classList.remove('display-n');
        } else {
            e.currentTarget.parentNode.nextElementSibling.classList.add('display-n');

        }
    })

    function renderVariant(color) {
        var html = $('#product-input-card').html()
        var template = Handlebars.compile(html);
        $('#variants').append(template({ color: color }));

    }

    $(document).on('click', 'button#moreImages', function (evt) {
        var test = $(evt.target);
        var target = test.closest('.variant-card').find('.media .file-field');
        var currentCount = target.length;
        var newCount = currentCount + 1;
        var lastGroup = target.last();
        lastGroup.find('i.suffix').remove();
        var newSection = lastGroup.clone();
        newSection.append("<i class='material-icons prefix suffix' id='deleteMedia'>delete</i>");
        newSection.find('input').val("");
        newSection.insertAfter(lastGroup);
        newSection.find("input").each(function (index, input) {
            input.id = input.id.replace("_" + currentCount, "_" + newCount);
            input.name = input.name.replace("_" + currentCount, "_" + newCount);
        });
        newSection.find("span").each(function (index, label) {
            var l = $(label);
            var prevValue = l.html();
            var newValue = prevValue.replace(currentCount, newCount);
            l.html(newValue);
        });
        return false;
    })

    $(document).on('click', '#deleteMedia', function (e) {
        if (e.currentTarget.parentNode.parentNode.getElementsByClassName('file-field').length > 2) {
            e.currentTarget.parentNode.previousElementSibling.innerHTML += "<i class='material-icons prefix suffix' id='deleteMedia'>delete</i>"
        }
        e.currentTarget.parentNode.remove()
    })

    $(document).on('click', '#removeVariant', function (e) {
        var target = $(e.target);
        target.closest('.col').remove()
        var color = target.closest('.variant-card').find('.v_color').html();
        var index = colors.indexOf(color);
        colors.splice(index, 1);
        colors.remove()
    })

    $(document).on('click', '#submitProduct', function () {
        FetchDetails();
    })

    function FetchDetails() {
        var colors = [];
        product.name = $('#p_name').val();
        product.description = $('#p_desc').val();
        var variants = $('#variants .variant');
        $.each(variants, function (index, variant) {
            var variantDetails = {};
            var target = $(variant);
            var color = target.find('.v_color').html();
            variantDetails["color"] = color;
            var selectedSizes = target.find('input[type=checkbox]:checked');
            var sizeDetails = {};
            $.each(selectedSizes, function (index, element) {
                var target1 = $(element);
                var size = target1.attr("value");
                var quantity = target1.closest('.checkbox-wrapper').find('.input-quantity input').val().trim()
                sizeDetails[size] = quantity;
            })
            variantDetails["sizes"] = sizeDetails;
            // debugger;
            variantDetails["price"] = target.find('.v_price').val().trim();
            var media = target.find('.media input[type=file]');
            var mediaDetails = [];
            $.each(media, function (index, element) {
                mediaDetails.push(element.files[0]);
            })
            variantDetails["media"] = mediaDetails;
            colors.push(variantDetails);
        })
        var jsonStr = JSON.stringify(colors);
        $('body').html(jsonStr).addClass("white-text container").append("<br><button class='btn' onclick='location.reload()'>Go Back</button><br><p>Check console for better json view</p>");
        console.log(colors);
        console.log(product);
    }

});
