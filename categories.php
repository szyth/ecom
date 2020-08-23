<?php require('includes/header.inc.php');
$cat_id = mysqli_real_escape_string($con, $_GET['id']);
if ($cat_id > 0) {
    $get_product = get_product($con, '', $cat_id, '');
} else {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php } ?>




<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a class="breadcrumb"><?php echo $get_product['0']['categories'] ?></a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>


<?php

if (count($get_product) > 0) {

?>
    <div class="row" style="background-color: #fff;margin-bottom: 0px;">
        <div id="filters" class="col s12 m3" ;>
            <h1 class="title center">Filters</h1>

            <div class="divider"></div>

            <div class="filter_content">
                <div id="price" class="">
                    <h1 class="filter_head">Price <span class="right"> &#9662;</span></h1>
                    <form action="#" id="price_body" class="filter_options">
                        <p>
                            <label>
                                <input name="group1" type="radio" checked />
                                <span>Under Rs. 1000</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="group1" type="radio" />
                                <span>Rs.1000 to Rs.2500</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="group1" type="radio" checked />
                                <span>Rs. 2500 to Rs. 4000</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="group1" type="radio" />
                                <span>Rs. 4000 & ABOVE</span>
                            </label>
                        </p>
                    </form>
                </div>
                <div class="divider"></div>


                <div id="size" class="">
                    <h1 class="filter_head">Size <span class="right"> &#9662;</span></h1>
                    <form id="size_body" action="#" class="filter_options">
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>32</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>34</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>36</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>38</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>40</span>
                            </label>
                        </p>

                    </form>
                </div>
                <div class="divider"></div>

                <div id="type" class="">
                    <h1 class="filter_head">Type <span class="right"> &#9662;</span></h1>
                    <form id="type_body" action="#" class="filter_options">
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>Shirt</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>Kaftan</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>Ribbed</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>Sweater</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>Gown</span>
                            </label>
                        </p>

                    </form>
                </div>
                <div class="divider"></div>

                <div id="fabric" class="">
                    <h1 class="filter_head">Fabric <span class="right"> &#9662;</span></h1>
                    <form id="fabric_body" action="#" class="filter_options">
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>Velvet</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>Chiffon</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" checked="checked" />
                                <span>Denim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" />
                                <span>Poplin</span>
                            </label>
                        </p>


                    </form>
                </div>
                <div class="divider"></div>


                <div id="color" class="">
                    <h1 class="filter_head">Color <span class="right"> &#9662;</span></h1>
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


            </div>
            <div class="divider"></div>

        </div>
        <div class="col s12 m9" style="border-left: solid rgb(196, 196, 196) 1px;">
            <!-- ALL PRODUCTS -->
            <div id="new_arrivals">
                <div class="title center">
                    <h1>Category</h1>
                    <p>Some of the latest trends in town</p>
                </div>

                <div class="row center">
                    <?php foreach ($get_product as $list) { ?>


                        <div class="col s6 m4 l3">
                            <a href="product.php?id=<?php echo $list['id'] ?>" class="black-text">
                                <div class="dress-card box_shadow">
                                    <div class="dress-card-head">
                                        <img class="dress-card-img-top" src="<?php echo "media/product/" . $list['image'] ?>" alt="">
                                    </div>
                                    <div class="dress-card-body">
                                        <h4 class="dress-card-title"> <?php echo $list['name'] ?></h4>
                                        <p class="dress-card-para">
                                            <span class="dress-card-price">Rs.<?php echo $list['mrp'] ?> &ensp;</span>
                                            <span class="dress-card-crossed">Rs.<?php echo $list['price'] ?></span>
                                            <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                                        </p>
                                        <a id="product_button" class="waves-effect waves-light btn-small  btn-flat" href="product.php?id=<?php echo $list['id'] ?>">View
                                            More</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- ALL PRODUCTS - END -->

        </div>
    </div>
<?php } else {
    echo "Data not found";
}  ?>

<section style="background-color: rgb(255, 255, 255);">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>



<?php require('includes/footer.inc.php'); ?>