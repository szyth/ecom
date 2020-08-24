<?php require('includes/header.inc.php');
$cat_id = mysqli_real_escape_string($con, $_GET['id']);


$cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1 AND super_categories_id=$cat_id ORDER BY categories ASC");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}



$super_cat_res = mysqli_query($con, "SELECT super_category.*,categories.super_categories_id FROM super_category,categories WHERE super_category.id = categories.super_categories_id AND categories.super_categories_id=$cat_id");
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


<div class="row">
    <?php
    foreach ($cat_arr as $list) {
    ?>
        <div class="col s12 m4">
            <div class="card">
                <h1>
                    <a href="sub_categories.php?id=<?php echo $list['id'] ?>">
                        <?php echo $list['categories'] ?>
                    </a>
                </h1>
            </div>
        </div>
    <?php
    }
    ?>
</div>


<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>



<?php require('includes/footer.inc.php'); ?>