<?php require('includes/header.inc.php'); ?>


<!-- SLIDER -->

<div class="slider-container" style="background-color: #fff;">

    <div class="carousel carousel-slider">
        <?php
        $res = mysqli_query($con, "SELECT * FROM banner WHERE status=1 ORDER BY priority ASC");
        if (mysqli_num_rows($res)) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <a class="carousel-item" alt="No image found"><img src="media/slider/<?php echo $row['image'] ?>"></a>
            <?php  }
        } else { ?>
            <a class="carousel-item" alt="No image found"><img src="media/slider/0.jpg"></a>
        <?php } ?>

    </div>
    <!-- <div class="text-translate">
        <div>
            <h1 class="slider-title">Summer Collection 2020</h1>
        </div>
        <a href="#all_products" id="banner_button" class="waves-effect waves-light btn-large  btn-flat ">Shop Now!</a>

    </div> -->

</div>

<!-- NEW ARRIVALS -->
<div id="new_arrivals">
    <div class="title center">
        <h1>New Arrivals</h1>
        <p>Some of the latest trends in town</p>
    </div>


    <div class="">
        <div class="row product_container">
            <?php

            $get_product = get_product($con, '8', '', '');
            foreach ($get_product as $list) {

            ?>



                <div class="col s6 m4 l3 product_container_inner">
                    <div class="dress-card box_shadow center">
                        <a href="product.php?id=<?php echo $list['id'] ?>" class="black-text">
                            <div class="dress-card-head">
                                <img class="dress-card-img-top" src="media/product/<?php echo $list['image'][0] ?>" alt="">
                            </div>
                            <div class="dress-card-body">
                                <h4 class="dress-card-title"> <?php echo $list['name'] ?></h4>
                                <p class="dress-card-para">

                                    <?php
                                    if ($list['discount_type'] == "rate") {
                                        echo  '<span class="dress-card-crossed ">Rs. ' . $list['mrp'] . '</span> &ensp;  <span class="dress-card-price ">Rs. ' . ($list["mrp"] - $list["discount"]) . '</span>';
                                    } elseif ($list['discount_type'] == "percent") {
                                        echo '<span class="dress-card-crossed ">Rs. ' . $list['mrp'] . '</span> &ensp;  <span class="dress-card-price ">Rs. ' . ($list["mrp"] - (($list["discount"] * $list["mrp"]) / 100)) . '</span>';
                                    } else {
                                        echo '<span class="dress-card-price ">Rs. ' . $list["mrp"]  . '</span>';
                                    }
                                    ?>


                                    <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>
                                    </a>
                                    <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                                </p>
                            </div>
                        </a>

                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>
<!-- NEW ARRIVALS - END -->

<!-- PARALLAX -->
<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center breadcrumb_wrapper">
                <h5 class="header col s12">Some of the latest trends in town
                </h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
</div>
<!-- PARALLAX - END -->

<!-- ALL PRODUCTS -->
<div id="all_products">
    <div class="title center">
        <h1>All Products</h1>
        <p>Some of the latest trends in town</p>
    </div>


    <div class="row center product_container">

        <?php
        $get_product = get_product($con, '8', '', '');
        // prx($get_product);
        foreach ($get_product as $list) {
        ?>
            <div class="col s6 m4 l3 product_container_inner">
                <div class="dress-card box_shadow center">
                    <a href="product.php?id=<?php echo $list['id'] ?>" class="black-text">
                        <div class="dress-card-head">
                            <img class="dress-card-img-top" src="media/product/<?php echo $list['image'][0] ?>" alt="">
                        </div>
                        <div class="dress-card-body">
                            <h4 class="dress-card-title"> <?php echo $list['name'] ?></h4>
                            <p class="dress-card-para">

                                <?php
                                if ($list['discount_type'] == "rate") {
                                    echo  '<span class="dress-card-crossed ">Rs. ' . $list['mrp'] . '</span> &ensp;  <span class="dress-card-price ">Rs. ' . ($list["mrp"] - $list["discount"]) . '</span>';
                                } elseif ($list['discount_type'] == "percent") {
                                    echo '<span class="dress-card-crossed ">Rs. ' . $list['mrp'] . '</span> &ensp;  <span class="dress-card-price ">Rs. ' . ($list["mrp"] - (($list["discount"] * $list["mrp"]) / 100)) . '</span>';
                                } else {
                                    echo '<span class="dress-card-price ">Rs. ' . $list["mrp"]  . '</span>';
                                }
                                ?>


                                <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')" class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                                <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                            </p>
                        </div>
                    </a>

                </div>
            </div>
        <?php
        }
        ?>


    </div>
    <div class="center loadMOre">
        <a id="all_product_button" class="waves-effect waves-light btn-large  btn-flat center">Load More...</a>
        <input type="hidden" id="row" value="0">
        <input type="hidden" id="all" value="<?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM product_new")); ?>"></div>
</div>
<!-- ALL PRODUCTS - END -->



<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12 center">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <h4>Contact Us</h4>
                <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id
                    nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies
                    eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et
                    pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed.
                    Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam
                    eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et
                    ultrices
                    posuere cubilia Curae;</p>
            </div>
        </div>

    </div>
</div>



<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>