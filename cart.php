<?php require('includes/header.inc.php');
if (!empty($_SESSION['cart'])) {
?>


    <section>
        <div class="parallax-container valign-wrapper">
            <div class="section no-pad-bot">
                <div class="container">
                    <div class="row center">
                        <h5 class="header col s12">
                            <div class="breadcrumb_wrapper">
                                <a href="index.php" class="breadcrumb">Home</a>
                                <a class="breadcrumb">Cart</a>
                            </div>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
        </div>




    </section>

    <div class="container">

        <table class="highlight centered" id="cart">
            <thead>
                <tr>
                    <th>Product</th>
                    <th style="width:250px">Name</th>
                    <!-- <th>Old Price</th> -->
                    <th>Price</th>
                    <th style="width:10px">Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <?php



            foreach ($_SESSION['cart'] as $key => $val) {
                $productAr = get_product($con, '', '', $key);
                $pname = $productAr[0]['name'];
                // $mrp = $productAr[0]['mrp'];
                $price = $productAr[0]['price'];
                $image = $productAr[0]['image'];
                $qty = $val['qty'];
            ?>
                <tbody>
                    <tr>
                        <td>
                            <img class="responsive-img" style="width: 70px; height:70px;object-fit:cover" src="<?php echo "media/product/" . $image ?>" alt="">
                        </td>
                        <td><?php echo $pname ?></td>
                        <!-- <td>Rs. <?php echo $mrp ?></td> -->
                        <td>Rs. <?php echo $price ?></td>
                        <td>

                            <?php echo $qty ?>
                            <!-- <input id="<?php echo $key ?>qty" type="number" value="<?php echo $qty ?>">
                            <br>
                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">update</a></td> -->
                        <td>Rs. <?php echo $qty * $price ?></td>
                        <td>
                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')">
                                <i class="material-icons-outlined">delete</i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            <?php }
            ?>
        </table>
        <a id="continue_shopping_button" href="index.php" class="waves-effect waves-light btn-large  btn-flat"> Continue Shopping</a>


    <?php

    if (!isset($_SESSION['USER_LOGIN'])) {
        echo ' <a id="checkout_button" href="login.php" class="waves-effect waves-light btn-large  btn-flat right">Login to Checkout
    </a>';
    } else {
        echo ' <a id="checkout_button" href="checkout.php" class="waves-effect waves-light btn-large  btn-flat right">Checkout
    </a>';
    }
} else {
    echo '
        <div class="center"> 
            <h4><i class="material-icons-outlined" style="font-size: 6em;">sentiment_dissatisfied</i><br>Empty Cart</h4>        
            <a id="continue_shopping_button" href="index.php" class="waves-effect waves-light btn-large  btn-flat">Continue Shopping</a>
        </div>
        
<script>
    setTimeout(function() {
        window.location.href = "index.php#all_products";
    }, 1500)
</script>
';
}

    ?>



    </div>



    <section">
        <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
            <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

        </svg>
        </section>




        <?php require('includes/footer.inc.php'); ?>