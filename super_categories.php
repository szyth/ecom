<?php require('includes/header.inc.php');

?>

<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a class="breadcrumb">Categories</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/4.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>


<div class="row" class="container">
    <?php
    $super_cat_res = mysqli_query($con, "SELECT * FROM super_category WHERE status=1 ORDER BY super_category DESC");
    $i = 1;
    while ($row = mysqli_fetch_assoc($super_cat_res)) {
    ?>

        <div class="col s12 m4">
            <figure class="snip1581">
                <img src="media/category/<?php echo $i++; ?>.jpg" alt="profile" />
                <figcaption>
                    <h3 class="title3"><?php echo $row['super_category'] ?></h3>
                </figcaption>
                <a href="categories.php?id=<?php echo $row['id'] ?>">
                </a>
            </figure>
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