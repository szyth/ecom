<?php
require('includes/connection.inc.php');
require('includes/functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
    header('location:login.php');
    die();
}


$condition = '';
$condition1 = '';
if ($_SESSION['ADMIN_ROLE'] == 1) {
    $condition = " AND product.added_by = '" . $_SESSION['ADMIN_ID'] . "'";
    $condition1 = " AND added_by = '" . $_SESSION['ADMIN_ID'] . "'";
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    .loader-container {
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
    }

    .loader {
        margin: 100px auto;
        font-size: 25px;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        position: relative;
        text-indent: -9999em;
        -webkit-animation: load5 1.1s infinite ease;
        animation: load5 1.1s infinite ease;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        margin: auto;
    }

    @-webkit-keyframes load5 {

        0%,
        100% {
            box-shadow: 0em -2.6em 0em 0em #ffffff, 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.5), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.7);
        }

        12.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.7), 1.8em -1.8em 0 0em #ffffff, 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.5);
        }

        25% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.5), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.7), 2.5em 0em 0 0em #ffffff, 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        37.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.5), 2.5em 0em 0 0em rgba(255, 255, 255, 0.7), 1.75em 1.75em 0 0em #ffffff, 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        50% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.5), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.7), 0em 2.5em 0 0em #ffffff, -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        62.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.5), 0em 2.5em 0 0em rgba(255, 255, 255, 0.7), -1.8em 1.8em 0 0em #ffffff, -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        75% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.5), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.7), -2.6em 0em 0 0em #ffffff, -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        87.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.5), -2.6em 0em 0 0em rgba(255, 255, 255, 0.7), -1.8em -1.8em 0 0em #ffffff;
        }
    }

    @keyframes load5 {

        0%,
        100% {
            box-shadow: 0em -2.6em 0em 0em #ffffff, 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.5), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.7);
        }

        12.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.7), 1.8em -1.8em 0 0em #ffffff, 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.5);
        }

        25% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.5), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.7), 2.5em 0em 0 0em #ffffff, 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        37.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.5), 2.5em 0em 0 0em rgba(255, 255, 255, 0.7), 1.75em 1.75em 0 0em #ffffff, 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        50% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.5), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.7), 0em 2.5em 0 0em #ffffff, -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.2), -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        62.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.5), 0em 2.5em 0 0em rgba(255, 255, 255, 0.7), -1.8em 1.8em 0 0em #ffffff, -2.6em 0em 0 0em rgba(255, 255, 255, 0.2), -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        75% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.5), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.7), -2.6em 0em 0 0em #ffffff, -1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2);
        }

        87.5% {
            box-shadow: 0em -2.6em 0em 0em rgba(255, 255, 255, 0.2), 1.8em -1.8em 0 0em rgba(255, 255, 255, 0.2), 2.5em 0em 0 0em rgba(255, 255, 255, 0.2), 1.75em 1.75em 0 0em rgba(255, 255, 255, 0.2), 0em 2.5em 0 0em rgba(255, 255, 255, 0.2), -1.8em 1.8em 0 0em rgba(255, 255, 255, 0.5), -2.6em 0em 0 0em rgba(255, 255, 255, 0.7), -1.8em -1.8em 0 0em #ffffff;
        }
    }

    .mx-4 {
        margin: auto 50px;
    }

    .card-wrapper {
        padding: 0px 50px;
        margin-bottom: 0px;
    }

    .product-card {
        padding: 70px;
    }

    .product-card .input-field {
        margin: 15px 0px;
        width: 90%;
    }

    .card-panel.curvy {
        border-radius: 12px !important;
    }

    .variant-card {
        padding: 10px 24px;
    }

    .input-field.inline input {
        font-size: 1rem;
        text-align: center;
        width: 60px;
        height: 22px;
        margin-bottom: 0px;
        margin-top: 0px;
        margin-left: 30%;
    }

    .input-quantity {
        margin: 0px;
        height: 22px;
        font-size: 1rem;
    }

    .checkbox-wrapper {
        margin: 5px auto;
    }

    .display-n {
        display: none !important;
    }

    .file-field .suffix {
        right: 0px;
    }

    span.deleteVariant {
        float: right;
    }

    @media(max-width: 768px) {
        .card-wrapper {
            padding: 0px;
        }

        .product-card {
            padding: 30px;
        }

        .product-card .input-field {
            width: 100%;
        }
    }

    #deleteMedia:hover,
    #removeVariant:hover {
        cursor: pointer;
    }
</style>

<div class="loader-container">
    <div class="loader">Loading...</div>
</div>


<div class="container-fluid">
    <div style="position: relative;">
        <a style="position:absolute;left:10" class="btn btn-small red darken-4 z-depth-2" href="product.php">Go Back</a>
        <h3 class="center black-text"> Add Product</h3>
    </div>

    <div class="row card-wrapper">
        <div class="col s12">
            <form class="card-panel product-card curvy z-depth-5" enctype="multipart/form-data" method="POST" action="manage_product_submit.php">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <select id="sid" name="sid" class="form-control">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            $res = mysqli_query($con, "SELECT * FROM super_category ORDER BY super_category ASC");
                            while ($row = mysqli_fetch_assoc($res)) {

                                echo "<option value=" . $row['id'] . ">" . $row['super_category'] . "</option>";
                            }
                            ?>
                        </select>
                        <label>Category</label>
                    </div>

                    <div class="input-field col m6 s12">
                        <select name="categories_id" class="form-control" id="sub_cat">
                            <option value="" disabled selected>Select Sub Category</option>
                        </select>
                        <label>Sub-Category</label>
                    </div>

                    <div class="col m6 s12">
                        <div class="input-field">
                            <input type="text" id="p_name" class="validate">
                            <label for="p_name">Product Name</label>
                            <span class="helper-text" data-error="Name is required" data-success=""></span>
                        </div>

                    </div>
                    <div class="col m6 s12">
                        <div class="input-field">
                            <textarea id="p_desc" class="materialize-textarea validate"></textarea>
                            <label for="p_desc">Product Description</label>
                            <span class="helper-text" data-error="Description is required" data-success=""></span>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4 offset-m4 input-field mx-auto">
                        <input type="text" id="p_color" class="validate">
                        <label for="p_color">Product Color</label>
                        <span class="helper-text" data-error="Color is required" data-success=""></span>

                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center">
                        <button class="btn indigo darken-4 z-depth-2" type="" id="p-add-color">Add
                            Color</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="row card-wrapper" id="variants">
    </div>
    <br>
    <div class="row center">
        <div class="col s12">
            <p class="display-n red-text">Form is incomplete. Please check again and submit</p>
            <button class="btn btn-large white indigo-text text-darken-4 z-depth-5" id="submitProduct">Submit
                Product</button>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/popper.min.js" type="text/javascript"></script>
<script src="assets/js/plugins.js" type="text/javascript"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<script>
    // $.noConflict();
    jQuery(document).ready(function($) {
        "use strict";
        $('select').formSelect();
        var product = {
            name: "",
            description: ""
        };
        var colors = [];
        $('.loader-container').hide();

        $('form.product-card').submit(function(e) {
            var inputs = $('form.product-card').find('.input-field input, .input-field textarea');
            var valid = true;
            $.each(inputs, function(index, input) {
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
            } else
                e.preventDefault();
        })

        $(document).on('change', 'input[type=checkbox]', function(e) {
            if (e.currentTarget.checked) {
                e.currentTarget.parentNode.nextElementSibling.classList.remove('display-n');
            } else {
                e.currentTarget.parentNode.nextElementSibling.classList.add('display-n');

            }
        })

        function renderVariant(color) {
            var html = $('#product-input-card').html()
            var template = Handlebars.compile(html);
            $('#variants').append(template({
                color: color
            }));

        }

        $(document).on('click', 'button#moreImages', function(evt) {
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
            newSection.find("input").each(function(index, input) {
                input.id = input.id.replace("_" + currentCount, "_" + newCount);
                input.name = input.name.replace("_" + currentCount, "_" + newCount);
            });
            newSection.find("span").each(function(index, label) {
                var l = $(label);
                var prevValue = l.html();
                var newValue = prevValue.replace(currentCount, newCount);
                l.html(newValue);
            });
            return false;
        })

        $(document).on('click', '#deleteMedia', function(e) {
            if (e.currentTarget.parentNode.parentNode.getElementsByClassName('file-field').length > 2) {
                e.currentTarget.parentNode.previousElementSibling.innerHTML += "<i class='material-icons prefix suffix' id='deleteMedia'>delete</i>"
            }
            e.currentTarget.parentNode.remove()
        })

        $(document).on('click', '#removeVariant', function(e) {
            var target = $(e.target);
            target.closest('.col').remove()
            var color = target.closest('.variant-card').find('.v_color').html();
            var index = colors.indexOf(color);
            colors.splice(index, 1);
            colors.remove()
        })

        $(document).on('change', '.variant .media .file-field input[type=file]', function(e) {
            var target = $(this)[0];
            var jTarget = $(this)
            var file = target.files[0]
            console.log(file)

            var formData = new FormData();
            formData.append('file', file)
            $('.loader-container').show();
            $.ajax({
                url: 'fileHandle.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data) {
                        // alert(data)
                        if (data.indexOf('Failed') > -1) {
                            alert("Upload failed");
                            jTarget.val('')
                            jTarget.closest(".file-field").find("input.validate").val("")
                        } else if (data.indexOf('Not Supported') > -1) {

                            alert('Not Supported');
                            jTarget.val('')
                            jTarget.closest(".file-field").find("input.validate").val("")
                        }
                    }
                    $('.loader-container').hide();
                },
                error: function(e) {
                    $('.loader-container').hide();
                    alert("Upload failed")
                },
                cache: false,
                contentType: false,
                processData: false
            });
        })


        $(document).on('click', '#submitProduct', function() {
            FetchDetails();
        })

        function FetchDetails() {
            var colors = [];
            var category = $('#sid').val();
            var subcategory = $('#sub_cat').val();
            product.name = $('#p_name').val();
            product.description = $('#p_desc').val();
            var variants = $('#variants .variant');
            $.each(variants, function(index, variant) {
                var variantDetails = {};
                var target = $(variant);
                var color = target.find('.v_color').html();
                variantDetails["color"] = color;
                var selectedSizes = target.find('input[type=checkbox]:checked');
                var sizeDetails = {};
                $.each(selectedSizes, function(index, element) {
                    var target1 = $(element);
                    var size = target1.attr("value");
                    var quantity = target1.closest('.checkbox-wrapper').find('.input-quantity input').val().trim()
                    sizeDetails[size] = quantity;
                })
                variantDetails["sizes"] = sizeDetails;
                // debugger;
                variantDetails["price"] = target.find('.v_price').val().trim();
                variantDetails["mrp"] = target.find('.mrp').val().trim();
                var media = target.find('.media input[type=file]');
                var mediaDetails = [];
                $.each(media, function(index, element) {
                    mediaDetails.push(element.files[0].name);
                })
                variantDetails["media"] = mediaDetails;
                colors.push(variantDetails);
            })
            console.log(colors)
            $.ajax({
                url: "manage_product_submit.php",
                method: "POST",
                enctype: 'multipart/form-data',
                data: {
                    "product": JSON.stringify(product),
                    "colors": JSON.stringify(colors),
                    "category": category,
                    "subcategory": subcategory,

                },
                success: function(result) {
                    if (result && result.indexOf('Successfully') > -1) {
                        alert("Product Added Successfully!")
                        location.href = location.href
                    }
                }
            })
        }

    });
</script>
</body>

<script id="product-input-card" type="text/x-handlebars-template">
    <div class="col m4 s12 variant">
        <div class="card-panel curvy variant-card">
            <h6 class="left">Color: <span style="font-weight: bold;" class="v_color">{{color}}</span></h6>
            <p class="right"><i class='material-icons small' id='removeVariant'>delete</i></p>
            <div class="row">
                <div class="input-field col s12 v_size">
                    <p>Size:</p>
                    <div class="checkbox-wrapper">
                        <label>
                            <input type="checkbox" name="size[]" value="s" />
                            <span>S</span>
                        </label>
                        <div class="input-field inline input-quantity display-n">
                            <input type="text" id="s_quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="checkbox-wrapper">
                        <label>
                            <input type="checkbox" name="size[]" value="m" />
                            <span>M</span>
                        </label>
                        <div class="input-field inline input-quantity display-n">
                            <input type="text" id="m_quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="checkbox-wrapper">
                        <label>
                            <input type="checkbox" name="size[]" value="l" />
                            <span>L</span>
                        </label>
                        <div class="input-field inline input-quantity display-n">
                            <input type="text" id="l_quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="checkbox-wrapper">
                        <label>
                            <input type="checkbox" name="size[]" value="xl" />
                            <span>XL</span>
                        </label>
                        <div class="input-field inline input-quantity display-n">
                            <input type="text" id="xl_quantity" placeholder="Quantity">
                        </div>
                    </div>
    
                </div>
    
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="number" class="mrp">
                    <label for="mrp">MRP</label>
                    <span class="helper-text" data-error="This field is required" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <input type="number" class="validate v_price" step=".01">
                    <label for="v_price">Price per piece</label>
                    <!-- <span class="helper-text" data-error="This field is required" data-success=""></span> -->
                </div>
            </div>
            <div class="media row">
                <p>Media:</p>
    
                <div class="file-field input-field col s12">
                    <div class="btn">
                        <span>File 1</span>
                        <input type="file" name="file[]" id="v_file_1" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
            <div class="center">
                <button class="btn center" id="moreImages">Add More Images</button>
            </div>
        </div>
    </div>
</script>

</html>