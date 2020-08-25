<?php require('includes/header.inc.php');

if (isset($_POST['submit'])) {
    $search = get_safe_value($con, $_POST['search']);
    $sql = "SELECT * FROM product WHERE name LIKE '%$search%' OR short_desc LIKE '%$search%' OR description LIKE '%$search%'";
    $res = mysqli_query($con, $sql);
    $search_data = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $search_data[] =  $row;
    }
}



?>


<div class="row">
    <form class="col s8 offset-s2" method="POST">
        <div class="row">
            <div class="input-field col s10">
                <i class="material-icons prefix">search</i>
                <input id="search" name="search" type="text" class="validate">
                <label for="search" class="black-text">Search for Products</label>
            </div>
            <div class="col s2">
                <button type="submit" name="submit" id="search_button" class="waves-effect waves-light btn-large btn-flat center">Search</button>

            </div>
        </div>

    </form>
</div>




<div class="row center">


    <?php

    // $get_product = get_product($con, '8', '', '');
    if (!empty($search_data)) {
        echo  '<h4>Search results for "' . $search . '"</h4>';
        foreach ($search_data as $list) {
    ?>



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
    } else {
        if (isset($_POST['submit'])) {
            echo '<h4>No products for "' . $search . '"</h4>';
        }
    }
    ?>
</div>


<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>