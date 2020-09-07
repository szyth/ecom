<?php require('includes/header.inc.php');


$super_cat_id = mysqli_real_escape_string($con, $_GET['id']);
// $GLOBALS['super_cat'] = $super_cat_id;

$cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1 AND super_categories_id=$super_cat_id ORDER BY categories ASC");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}


$super_cat_res = mysqli_query($con, "SELECT super_category.*,categories.* FROM super_category,categories WHERE super_category.id = categories.super_categories_id AND categories.super_categories_id=$super_cat_id");
$super_cat_arr = array();
$cat_id = array();
while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
    $super_cat_arr[] = $row1;
    $cat_id[] = $row1['id'];
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
                            <a class="breadcrumb">
                                <?php
                                // echo prx($super_cat_arr);
                                echo $super_cat_arr[0]['super_category'];
                                ?>
                            </a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/4.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>



<div class="row" style="background-color: #fff;margin-bottom: 0px;">
    <div id="filters" class="col s12 m3" ;>
        <h1 class="title center"><i class="material-icons-outlined" style="font-size: 1.3em;">settings</i>&nbsp;Filters </h1>

        <div class="divider"></div>

        <div id="filter_body" class="filter_content">
            <div id="subcategory" class="">
                <h1 class="filter_head">Sub Categories <span class="right"> &#9662;</span></h1>
                <form action="#" id="subcategory_body" class="filter_options">
                    <ol style="list-style-type: circle;">
                        <?php
                        foreach ($cat_arr as $list) {
                        ?>
                            <li>
                                <a id="cat_button" href="sub_categories.php?id=<?php echo $list['id'] ?>" class="black-text">
                                    <?php echo $list['categories'] ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ol>

                </form>
            </div>


            <div class="divider"></div>
            <div id="price" class="">
                <h1 class="filter_head">Price <span class="right"> &#9662;</span></h1>
            </div>
            <form action="#" id="price_body" class="filter_options">
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="65000" />
                <p id="price_show">100 - 65000</p>
                <div id="price_range"></div>
            </form>


            <div class="divider"></div>


            <div id="size" class="">
                <h1 class="filter_head">Size <span class="right"> &#9662;</span></h1>
            </div>
            <form id="size_body" action="#" class="filter_options">
                <?php
                $query = "
                    SELECT DISTINCT(size) FROM product WHERE status = '1' ORDER BY size ASC
                    ";
                $res = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="filled-in common_selector size" value="<?php echo $row['size']; ?>">
                            <span><?php echo $row['size']; ?></span>
                        </label>
                    </div>
                <?php
                }
                ?>
            </form>

            <div class="divider"></div>

            <div id="type" class="">
                <h1 class="filter_head">BRAND <span class="right"> &#9662;</span></h1>
            </div>
            <form id="type_body" action="#" class="filter_options">
                <?php

                $query = "SELECT DISTINCT(brand) FROM product WHERE status = '1' ORDER BY id DESC";
                $res = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="filled-in common_selector brand" value="<?php echo $row['brand']; ?>">
                            <span><?php echo $row['brand']; ?></span>
                        </label>
                    </div>
                <?php
                }

                ?>
            </form>
            <div class="divider"></div>

            <div id="fabric" class="">
                <h1 class="filter_head">Fabric <span class="right"> &#9662;</span></h1>
            </div>
            <form id="fabric_body" action="#" class="filter_options">
                <?php

                $query = "
                    SELECT DISTINCT(fabric) FROM product WHERE status = '1' ORDER BY fabric DESC
                    ";
                $res = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="filled-in common_selector fabric" value="<?php echo $row['fabric']; ?>">
                            <span><?php echo $row['fabric']; ?></span>
                        </label>
                    </div>
                <?php
                }

                ?>
            </form>
            <div class="divider"></div>


            <div id="color" class="">
                <h1 class="filter_head">Color <span class="right"> &#9662;</span></h1>
            </div>
            <form id="color_body" action="#" class="filter_options color_buttons">
                <a class="btn-floating  yellow darken-1"><i class="material-icons">done</i></a>
                <a class="btn-floating  red darken-1"><i class="material-icons"></i></a>
                <a class="btn-floating  green darken-1"><i class="material-icons"></i></a>
                <a class="btn-floating  blue darken-1"><i class="material-icons">done</i></a>
                <a class="btn-floating  black darken-1"><i class="material-icons"></i></a>
                <a class="btn-floating  indigo darken-1"><i class="material-icons"></i></a>
                <a class="btn-floating  orange darken-1"><i class="material-icons"></i></a>
                <a class="btn-floating  teal darken-1"><i class="material-icons"></i></a>
            </form>



        </div>
        <div class="divider"></div>

    </div>
    <div class="col s12 m9" style="border-left: solid rgb(196, 196, 196) 1px;">
        <!-- FILTERED PRODUCTS -->
        <div id="new_arrivals" class="product_container">
            <div class="title center">
                <h1>
                    <?php echo $super_cat_arr[0]['super_category']; ?>
                </h1>
                <!-- <p>Some of the latest trends in town</p> -->
            </div>

            <!-- <div class="row center">
                <?php
                foreach ($cat_id as $id) {
                    $get_product = get_product($con, '', $id, '');
                    foreach ($get_product as $list) {
                ?>


                        <div class="col s6 m4 l3 product_container_inner">
                            <a href="product.php?id=<?php echo $list['id'] ?>" class="black-text">
                                <div class="dress-card box_shadow">
                                    <div class="dress-card-head">
                                        <img class="dress-card-img-top" src="<?php echo "media/product/" . $list['image'] ?>" alt="">
                                    </div>
                                    <div class="dress-card-body">
                                        <h4 class="dress-card-title"> <?php echo $list['name'] ?></h4>
                                        <p class="dress-card-para">
                                            <span class="dress-card-price">Rs.<?php echo $list['price'] ?> &ensp;</span>
                                            <span class="dress-card-crossed">Rs.<?php echo $list['mrp'] ?></span>
                                        </p>
                                        <a id="product_button" class="waves-effect waves-light btn-small  btn-flat" href="product.php?id=<?php echo $list['id'] ?>">View
                                            More</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </div> -->
            <div class="row filter_data center ">

            </div>
        </div>

        <!-- FILTERED PRODUCTS - END -->

    </div>
</div>
<?php
?>

<section style="background-color: rgb(255, 255, 255);">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>