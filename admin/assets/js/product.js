var productForm = {
    isValidated: true,
    isSuccess: false
}

$(document).ready(function () {

    // Submit
    $("form#product-form").on("submit", function (e) {
        e.preventDefault();
        validateFields();
        if (productForm.isValidated) {
            formToJson();
            // location.href = location.href;
        }
    });

    // Add Product
    $("#add-product").on("click", function () {
        var target = $("#product-form").find(".card");
        var lastProduct = target.last();
        if (lastProduct.find("select[name=cat]").val()) {
            var newProduct = lastProduct.clone();
            var count = target.length + 1;
            var selects = lastProduct.find("select");
            newProduct.find(".card-header strong").html("Product " + count).append('<a href="javascript:void(0)" class="btn" id="remove-product">Remove</a>');
            newProduct.find("select").each(function (index, elem) {
                $(elem).val(selects.eq(index).val());
            })
            newProduct.find("select[name=cat]").attr("disabled", true);
            newProduct.find("select[name=subcat]").attr("disabled", true);

            newProduct.find(".form-control").each(function (index, elem) {
                if (!$(elem).attr("disabled")) {
                    $(elem).val("");
                }
            })

            newProduct.insertAfter(lastProduct);
        } else {
            alert("Please Select a Category");
        }

    })

    // Remove Product
    $(document).on("click", "#remove-product", function () {
        $(this).closest(".card").remove();
    })

    // Fetch Subcategories
    $(document).on("change", "select[name='cat']", function () {
        var src = $(this);
        var sid = src.val();
        $.ajax({
            url: 'includes/get_api.php',
            method: 'post',
            data: { "target": "subcategory", "cat_id": sid },
        }).done(function (cat) {
            cat = JSON.parse(cat);
            src.closest(".card-body").find("select[name='subcat']").empty();
            cat.forEach(function (subcat) {
                src.closest(".card-body").find("select[name='subcat']").removeAttr("disabled").append('<option value=' + subcat.id + '>' + subcat.categories + '</option>')
            });

        });
    });

    // Add Select options
    $(document).on("click", "a.label-link", function (e) {
        var target = $(this).closest(".form-group").find("select").attr("name");

        switch (target) {
            case "subcat":
                addSubcategry($(this));
                break;
            case "color":
                addColor();
                break;
            case "size":
                addSize();
                break;
            default:
                target = $(this).closest(".form-group").find("input").attr("type");
                if (target === "file")
                    addImageField($(this));
                else
                    console.log("Invalid Add target");
                break;
        }

    });

    $(document).on("click", "a#remove", function (e) {
        $(this).closest(".row").remove();
    })

    // Clearing Modals
    $("#subcat-modal, #gen-modal").on('hidden.bs.modal', function () {
        $(this).find("input").val("");
    });

    // Add Subcategory
    $("#subcat-modal .modal-footer #sc_submit").on("click", function (e) {
        var cat_id = $(this).closest('.modal-dialog').find("input[name=sc_modal_cat]").data("id");
        var subcategory = $(this).closest('.modal-dialog').find("input[name=sc_modal_subcat]").val();

        if (cat_id && subcategory && subcategory.trim() && subcategory.trim().length) {
            $(this).closest('.modal-dialog').find("input[name=sc_modal_subcat]").closest(".form-group").find("span.error").html("").hide();
            $.ajax({
                url: "includes/post_api.php",
                type: "POST",
                data: { "target": "subcategory", "super_categories_id": cat_id, "value": subcategory },
                success: function (response) {
                    alert(response);
                    $("select[name='cat']").val(cat_id).trigger("change");
                    $("#subcat-modal").modal("toggle");
                },
                error: function (response) {
                    alert(response);
                }
            });
        } else {
            $(this).closest('.modal-dialog').find("input[name=sc_modal_subcat]").closest(".form-group").find("span.error").html("This field is required").show();
        }

        return false;
    });

    // Add Color and Size
    $("#gen-modal .modal-footer #gen_submit").on("click", function (e) {
        var validated = true;

        $(this).closest('.modal-dialog').find(".form-control").each(function (index, elem) {
            var attrValue = $(elem).val();
            if (attrValue && attrValue.trim() && attrValue.trim().length) {
                $(elem).closest(".form-group").find("span.error").html("").hide();
            } else {
                $(elem).closest(".form-group").find("span.error").html("This field is required").show();
                validated = false;
            }
        });

        var target = $("#gen-modal").data("target");

        if (validated && target) {
            var value = $(this).closest('.modal-dialog').find("input[name=gen_modal_val]").val();
            var name = $(this).closest('.modal-dialog').find("input[name=gen_modal_name]").val();

            $.ajax({
                url: "includes/post_api.php",
                type: "POST",
                data: { "target": target, "value": value, "name": name },
                success: function (response) {
                    alert(response);
                    populateSelect(target);
                    $("#gen-modal").modal("toggle");
                },
                error: function (response) {
                    alert(response);
                }
            });
        }

        return false;
    });

    //File Upload
    $(document).on('change', '#product-form .media-wrapper input[type=file]', function (e) {
        var target = $(this)[0];
        var jTarget = $(this)
        var file = target.files[0]
        var filename = file.name;
        var ext = filename.substr(filename.lastIndexOf("."), filename.length);
        var newFileName = createFileId(20) + ext;
        $(this).data("newFileName", newFileName);
        // console.log(file)

        var formData = new FormData();
        formData.append('file', file, newFileName);
        // $('.loader-container').show();
        $.ajax({
            url: 'fileHandle.php',
            type: 'POST',
            data: formData,
            success: function (data) {
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
                // $('.loader-container').hide();
            },
            error: function (e) {
                // $('.loader-container').hide();
                alert("Upload failed");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on("change", "input[name=discount-type]", function () {
        var attrVal = $(this).val();
        if (attrVal === "percent" || attrVal === "rate") {
            $(this).closest(".row").find("input[name=discount]").closest(".col-lg-6").removeClass("display-n");
        } else {
            $(this).closest(".row").find("input[name=discount]").val("").closest(".col-lg-6").addClass("display-n");
        }
    })

    var validateFields = function () {
        productForm.isValidated = true;
        $("form#product-form").find(".form-control").each(function (index, elem) {
            if (!$(elem).closest(".col-lg-6").hasClass("display-n") && !$(elem).hasClass("optional-field")) {
                var attrValue = $(elem).val();
                if (attrValue && attrValue.trim() && attrValue.trim().length) {
                    $(elem).closest(".form-group").find("span.error").html("").hide();
                } else {
                    $(elem).closest(".form-group").find("span.error").html("This field is required").show();
                    productForm.isValidated = false;
                }
            }
        });
    }

    var addSubcategry = function (target) {
        var cat_id = target.closest(".row").find("select[name=cat]").val();
        var cat_val = target.closest(".row").find("select[name=cat] option:selected").text();

        if (cat_id && cat_id.length) {
            $("#subcat-modal").find("input[name=sc_modal_cat]").val(cat_val).data("id", cat_id).attr("disabled", true);
            $("#subcat-modal").modal("show")
        } else {
            alert("Please Select a Category");
        }
    }
    var addColor = function () {
        $("#gen-modal").find("#gen_modal_title").html("Add Product Color");
        $("#gen-modal").data("target", "color").modal("show");
    }
    var addSize = function () {
        $("#gen-modal").find("#gen_modal_title").html("Add Product Size");
        $("#gen-modal").data("target", "size").modal("show");
    }
    var addImageField = function (target) {
        var count = target.closest(".media-wrapper").find(".row").length + 1;
        target.closest(".media-wrapper").append('<div class="row"> <div class="col-lg-6 col-sm-12"> <div class="form-group"> <a href="javascript:void(0)" class="btn btn-default" id="remove">Remove</a> <a href="javascript:void(0)" class="btn btn-default label-link">Add More</a> <label for="image_1">Product Image ' + count + '</label> <input type="file" name="image_' + count + '" class="form-control" accept="image/*"> <span class="error"></span> </div> </div> </div>')
    }

    // Populating Size and Color
    var populateSelect = function (target) {
        if (target) {
            $.ajax({
                url: 'includes/get_api.php',
                method: 'post',
                data: { "target": target },
            }).done(function (parent) {
                parent = JSON.parse(parent);
                $("select[name='" + target + "']").empty();
                parent.forEach(function (child) {
                    $("select[name='" + target + "']").append('<option value=' + child.id + '>' + child.name + '</option>')
                });
            });
        }
    }

    var createFileId = function (length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    var formToJson = function () {
        var isSuccess = false;
        var products = [];
        $("form#product-form").find(".card").each(function (index, elem) {
            var productDetail = {};
            var imageCount = 0;
            $(elem).find(".form-control").each(function (i, e) {
                var attrValue = $(e).val();
                var attrName = $(e).attr("name");
                var type = $(e).attr("type");

                if (attrName && attrValue) {
                    if (type === "file") {
                        productDetail[attrName] = $(e).data("newFileName");
                        imageCount++;
                    } else if (attrName === "discount") {
                    }
                    else
                        productDetail[attrName] = attrValue;
                }
            });

            var discountType = $(elem).find("input[name=discount-type]:checked").val();
            if (discountType !== "none") {
                productDetail["discount"] = $(elem).find("input[name=discount]").val();
            }
            productDetail["discount-type"] = discountType;

            productDetail["imageCount"] = imageCount;
            products.push(productDetail);
        });
        if (products.length) {
            $.ajax({
                url: "includes/post_api.php",
                type: "POST",
                data: { "target": "products", "data": products },
                success: function (response) {
                    alert(response);
                },
                error: function (error) {
                    alert(error);
                }
            })
        }
        console.log(products);
    }

});