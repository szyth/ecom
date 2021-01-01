<?php
require('includes/top.inc.php');
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

<style>
    /* .loader-container {
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
    } */
    #product-form .form-group {
        margin-top: 20px;
    }
    .form-group span.error {
        font-size: 0.8rem;
        color: crimson;
        display: none;
    }
    #product-form .form-group a.label-link {
        font-size: 0.8rem;
        float: right;
        background-color: #337ab7;
        color: #fff;
        padding: 2px 8px;
    }
    #product-form .form-group a#remove {
        font-size: 0.8rem;
        float: right;
        background-color: #d9534f;
        color: #fff;
        padding: 2px 8px;
        margin-left: 10px;
    }
    #product-form a#remove-product {
        font-size: 0.8rem;
        float: right;
        background-color: #d9534f;
        color: #fff;
        padding: 2px 8px;
    }
    .form-group label sup {
        color: crimson;
    }
    #product-form .form-group input[type=file] {
        height: 100%;
    }
    .display-n {
        display: none;
    }
</style>

<!-- <div class="loader-container">
    <div class="loader">Loading...</div>
</div> -->
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mb-4 text-center">ADD PRODUCT FORM</h4>
                <form action="" id="product-form" novalidate>

                    <div class="card">
                        <div class="card-header">
                            <strong>Product 1</strong>
                        </div>
                            <div class="card-body card-block">

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="cat" class="control-label">Category <sup>*</sup></label>
                                            <select type="select" name="cat" class="form-control" placeholder="Select Category" required>
                                                <option value="" disabled selected>Select Category</option>
                                                <?php
                                                $res = mysqli_query($con, "SELECT * FROM super_category ORDER BY super_category ASC");
                                                while ($row = mysqli_fetch_assoc($res)) {

                                                    echo "<option value=" . $row['id'] . ">" . $row['super_category'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="subcat" class="control-label">Sub Category <sup>*</sup></label>
                                            <a href="javascript:void(0)" class="btn btn-default label-link">Add More</a>
                                            <select type="select" name="subcat" class="form-control" placeholder="Select Category" disabled required>
                                                <option value="" default>Select Sub Category</option>
                                            </select>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Product Name <sup>*</sup></label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="desc" class="control-label">Product Description <sup>*</sup></label>
                                            <textarea name="desc" class="form-control" rows="4" required></textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="color" class="control-label">Product Color <sup>*</sup></label>
                                            <a href="javascript:void(0)" class="btn btn-default label-link">Add More</a>
                                            <select type="select" name="color" class="form-control" placeholder="Select Color" required>
                                                <option value="" disabled selected>Select Color</option>
                                                <?php
                                                $res = mysqli_query($con, "SELECT * FROM product_color ORDER BY value ASC");
                                                while ($row = mysqli_fetch_assoc($res)) {

                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="size" class="control-label">Product Size <sup>*</sup></label>
                                            <a href="javascript:void(0)" class="btn btn-default label-link">Add More</a>
                                            <select type="select" name="size" class="form-control" placeholder="Select Size" required>
                                                <option value="" disabled selected>Select Size</option>
                                                <?php
                                                $res = mysqli_query($con, "SELECT * FROM product_size ORDER BY value ASC");
                                                while ($row = mysqli_fetch_assoc($res)) {

                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="color" class="control-label">Product MRP <sup>*</sup> </label>
                                            <input type="number" name="mrp" class="form-control" placeholder="Enter MRP" required>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <h5 class="mb-2 mt-3">Discount Type</h5>
                                        <div class="radio ml-3">
                                            <label>
                                                <input type="radio" name="discount-type" value="rate">
                                                Rate Discount
                                            </label>
                                        </div>
                                        <div class="radio ml-3">
                                            <label>
                                                <input type="radio" name="discount-type" value="percent">
                                            Percentage Discount
                                            </label>
                                        </div>
                                        <div class="radio ml-3">
                                            <label>
                                                <input type="radio" name="discount-type" value="none" checked>
                                                None
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 display-n">
                                        <div class="form-group">
                                            <label for="discount" class="control-label">Discount <sup>*</sup></label>
                                            <input type="number" name="discount" class="form-control" placeholder="Enter Discount (if any)">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="articleid" class="control-label">Product Article ID</label>
                                            <input type="text" name="articleid" class="form-control optional-field" placeholder="Enter Article ID">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="quantity" class="control-label">Quantity <sup>*</sup></label>
                                            <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="media-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <a href="javascript:void(0)" class="btn btn-default label-link">Add More</a>
                                                <label for="image_1">Product Image 1</label>
                                                <input type="file" name="image_1" class="form-control" accept="image/*">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 text-center mb-4">
                        <a class="btn btn-success text-white" id="add-product">Add More Products</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<section class="custom-modal">
    <!-- Subcategory Add Modal -->
    <div class="modal fade" id="subcat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Sub Category</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="sc_modal_cat" class="control-label">Product Category <sup>*</sup> </label>
                        <input type="text" name="sc_modal_cat" class="form-control" required>
                        <span class="error"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="sc_modal_subcat" class="control-label">Product Sub Category <sup>*</sup></label>
                        <input type="text" name="sc_modal_subcat" class="form-control" placeholder="Enter Sub Category">
                        <span class="error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sc_submit">Submit</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Color/Size Add Modal -->
    <div class="modal fade" id="gen-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gen_modal_title">Add Color</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="gen_modal_val" class="control-label">Value <sup>*</sup> </label>
                        <input type="text" name="gen_modal_val" class="form-control" required>
                        <span class="error"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="gen_modal_name" class="control-label">Name <sup>*</sup> </label>
                        <input type="text" name="gen_modal_name" class="form-control" required>
                        <span class="error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="gen_submit">Submit</button>
            </div>
            </div>
        </div>
    </div>
</section>


<?php
require('includes/footer.inc.php');
?>