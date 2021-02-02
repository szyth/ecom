<?php require('includes/header.inc.php');
$product_id = mysqli_real_escape_string($con, $_GET['id']);
if ($product_id > 0) {
    $get_product = get_product($con, '', '', $product_id);
} else {
?>
    <script>
        window.location.href = 'index.php'
    </script>


<?php
}

$cat_id = $get_product['0']['subcat_id'];

$super_cat_res = mysqli_query($con, "SELECT super_category.*,categories.super_categories_id FROM super_category,categories WHERE super_category.id = categories.super_categories_id AND categories.id=$cat_id");
$super_cat_arr = array();
while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
    $super_cat_arr[] = $row1;
}

// prx($get_product['0']);
?>




<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a href="super_categories.php" class="breadcrumb">Categories</a>
                            <a href="categories.php?id=<?php echo $super_cat_arr[0]['super_categories_id'] ?>" class="breadcrumb">
                                <?php
                                echo $super_cat_arr[0]['super_category'];
                                ?>
                            </a>
                            <a href="sub_categories.php?id=<?php echo $get_product['0']['subcat_id'] ?>" class="breadcrumb"><?php echo $get_product['0']['categories'] ?></a>
                            <a class="breadcrumb"><?php echo $get_product['0']['name'] ?></a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/4.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>


<!-- PRODUCT -->
<div class="row">
    <br>
    <div class="col m4 push-m1 l4 push-l1 s12 product_image">
        <div class="d-flex flex-column thumbnails">
            <?php
            $active = 'tb-active';
            for ($i = 0; $i < count($get_product[0]['image']); $i++) {
                $active = $i > 0 ? '' : 'tb-active';
            ?>
                <div id="f<?php echo $i + 1 ?>" class="tb <?php echo $active ?>"> <img class="thumbnail-img fit-image" src="media/product/<?php echo $get_product['0']['image'][$i] ?>"> </div>
            <?php } ?>
        </div>

        <?php
        $active = 'active';
        for ($i = 0; $i < count($get_product[0]['image']); $i++) {
            $active = $i > 0 ? '' : 'active';
        ?>
            <fieldset id="f<?php echo $i + 1 ?>1" class="<?php echo $active ?>">
                <div class="product-pic"> <img class="pic0 block__pic" src="media/product/<?php echo $get_product['0']['image'][$i] ?>"> </div>
            </fieldset>
        <?php } ?>

    </div>
    <div class="col m6 push-m1 l6 push-l1 s10 push-s1">
        <div class="product_details">
            <h2 class="product_title"><?php echo $get_product['0']['name'] ?></h2>
            <ul class="">

                <?php
                if ($get_product['0']['discount_type'] == "rate") {
                    echo  '<li class="mrp">Rs. ' . $get_product['0']['mrp'] . '</li>
                     <li class="price">Rs. ' . ($get_product['0']["mrp"] - $get_product['0']["discount"]) . '</li>';
                } elseif ($get_product['0']['discount_type'] == "percent") {
                    echo '<li class="mrp">Rs. ' . $get_product['0']['mrp'] . '</li>
                    <li class="price">Rs. ' . ($get_product['0']["mrp"] - (($get_product['0']["discount"] * $get_product['0']["mrp"]) / 100)) . '</li>';
                } else {
                    echo '<li class="price">Rs. ' . $get_product['0']["mrp"]  . '</li>';
                }

                ?>
                <!-- <li class="mrp">Rs. <?php echo $get_product['0']['mrp'] ?></li>
                <li class="price">Rs. <?php echo $get_product['0']['mrp'] - $get_product['0']['discount']  ?></li> -->
            </ul>
            <p class=""><?php echo $get_product['0']['description'] ?></p>
            <div class="">
                <b>Available Colors : Size</b>
                <br>
                <?php
                $getParentId = $get_product['0']['parent_id'];
                // prx($sizeId);
                $response = (mysqli_query($con, "SELECT id,color,size FROM product_new WHERE parent_id=$getParentId"));
                while ($size_color_id = mysqli_fetch_assoc($response)) {
                    $colorSQL = "SELECT name as color FROM product_color where id='" . $size_color_id['color'] . "'";
                    $color = mysqli_fetch_assoc(mysqli_query($con, $colorSQL));
                    $size = mysqli_fetch_assoc(mysqli_query($con, "SELECT name as size FROM product_size where id=" . $size_color_id['size'] . ""));
                ?>
                    <?php
                    if ($size_color_id['id'] == $product_id) {
                    ?>
                        <a href="product.php?id=<?php echo $size_color_id['id'] ?>" id="colors" class="waves-effect waves-light btn-large btn-flat product-active"><?php echo $color['color'] . " : " . $size['size'] ?></a>
                    <?php } else {
                    ?>
                        <a href="product.php?id=<?php echo $size_color_id['id'] ?>" id="colors" class="waves-effect waves-light btn-large btn-flat"><?php echo $color['color'] . " : " . $size['size'] ?></a>
                    <?php
                    }
                    ?>

                <?php } ?>
                <br>


                <?php if ($get_product['0']['quantity']) {
                ?>
                    <div class="product_availability">
                        <p><span class="black-text">Availability:</span>&nbsp;
                            <?php
                            echo '<span id="available">' . $get_product['0']['quantity'] . "</span> in stock";
                            ?></p>
                    </div>
                    <div class="">
                        <b>Quantity:</b>
                        <input id="qty" style="width: 50px;text-align:center;margin:0 10px" value="1" type="number">
                        <input class="inc" type="button" id='increment' value="+" />
                        <input class="dec" type="button" id='decrement' value="-" />
                    </div>

                <?php
                } else {
                ?>
                    <div class="product_availability">
                        <p><span class="black-text">Availability:</span>&nbsp;
                        <?php
                        echo 'Out of Stock';
                    }
                        ?>
                        <div class="product_category">
                            <span class="black-text">Category:</span> <a href="sub_categories.php?id=<?php echo $get_product['0']['subcat_id'] ?>"> <?php echo $get_product['0']['categories'] ?></a>
                        </div>


                        <?php

                        $price = 0;
                        if ($get_product['0']['discount_type'] == 'rate') {
                            $price = ($get_product['0']['mrp'] - $get_product['0']['discount']);
                        } elseif ($get_product['0']['discount_type'] == 'percent') {
                            $price = ($get_product['0']['mrp'] - (($get_product['0']['discount'] * $get_product['0']['mrp']) / 100));
                        } else {
                            $price = $get_product['0']['mrp'];
                        }

                        ?>
                        <?php if ($get_product['0']['quantity']) {
                        ?>
                            <a id="add_to_cart" class="waves-effect waves-light btn-large btn-flat" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add','<?php echo $price ?>')">Add to cart</a>
                        <?php } ?>

                        <!-- WISHLIST -->
                        <?php $uid = $_SESSION['USER_ID'];
                        $count = mysqli_num_rows(mysqli_query($con, "select * from wishlist where product_id =$product_id AND user_id=$uid"));
                        if ($count) {
                        ?> <a class="wishlist-button remove waves-effect waves-light btn-large btn-flat" href="javascript:void(0)" onclick="wishlist_manage('<?php echo $get_product['0']['id'] ?>','remove')">Remove from Wishlist
                            </a>
                        <?php
                        } else {
                        ?>

                            <a class="wishlist-button add waves-effect waves-light btn-large btn-flat" href="javascript:void(0)" onclick="window.location.reload();wishlist_manage('<?php echo $get_product['0']['id'] ?>','add');">Add To Wishlist
                            </a>

                        <?php
                        }
                        ?>


                    </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT - END -->

    <section>
        <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
            <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

        </svg>
    </section>


    <?php require('includes/footer.inc.php'); ?>