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

$cat_id = $get_product['0']['categories_id'];

$super_cat_res = mysqli_query($con, "SELECT super_category.*,categories.super_categories_id FROM super_category,categories WHERE super_category.id = categories.super_categories_id AND categories.id=$cat_id");
$super_cat_arr = array();
while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
    $super_cat_arr[] = $row1;
}

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
                            <a href="sub_categories.php?id=<?php echo $get_product['0']['categories_id'] ?>" class="breadcrumb"><?php echo $get_product['0']['categories'] ?></a>
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
    <div class="col m4 push-m1 l4 push-l1 s12 product_image">
        <img src="<?php echo "media/product/" . $get_product['0']['image'] ?>" class="block__pic" alt="">
    </div>


    <div class="col m6 push-m1 l6 push-l1 s10 push-s1">
        <div class="product_details">
            <h2 class="product_title"><?php echo $get_product['0']['name'] ?></h2>
            <ul class="">
                <li class="mrp">Rs. <?php echo $get_product['0']['mrp'] ?></li>
                <li class="price">Rs. <?php echo $get_product['0']['price'] ?></li>
            </ul>
            <p class=""><?php echo $get_product['0']['short_desc'] ?></p>
            <p class=""><?php echo $get_product['0']['description'] ?></p>
            <div class="">
                <div class="product_availability">
                    <p><span class="black-text">Availability:</span> In Stock</p>
                </div>
                <div class="">
                    <p><span>Quantity:</span>
                        <select id="qty" class="browser-default">
                            <option value="1" selected>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </p>
                </div>
                <div class="product_category">
                    <span class="black-text">Category:</span> <a href="sub_categories.php?id=<?php echo $get_product['0']['categories_id'] ?>"> <?php echo $get_product['0']['categories'] ?></a>
                </div>

                <a id="add_to_cart" class="waves-effect waves-light btn-large btn-flat" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add','<?php echo $get_product['0']['price'] ?>')">Add to cart</a>

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