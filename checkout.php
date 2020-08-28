<?php require('includes/header.inc.php');
if (!isset($_SESSION['USER_LOGIN'])) {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php
}
if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php
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
                            <a class="breadcrumb">Checkout</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/4.jpg" alt="Unsplashed background img 2"></div>
    </div>




</section>

<div class="row">
    <div class="col s12 m4" style="border: solid #444 1px;padding:20px">
        <div class=" center">
            <h4>Order Details </h4>
            <div class="divider"></div>
            <table class="highlight centered responsive-table" id="cart">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <?php
                $cart_total = 0;
                foreach ($_SESSION['cart'] as $key => $val) {
                    $productAr = get_product($con, '', '', $key);
                    $pname = $productAr[0]['name'];
                    $mrp = $productAr[0]['mrp'];
                    $price = $productAr[0]['price'];
                    $image = $productAr[0]['image'];
                    $qty = $val['qty'];
                    $cart_total = $cart_total + ($price * $qty);
                ?>
                    <tbody>
                        <tr>
                            <td>
                                <img class="responsive-img" style="width: 30px; height:30px;object-fit:cover" src="<?php echo "media/product/" . $image ?>" alt="">
                            </td>
                            <td><?php echo $pname ?></td>
                            <td>Rs. <?php echo $price * $qty ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')">
                                    <i class="material-icons-outlined">delete</i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>

            <div class="divider"></div>
            <h6 class="left">ORDER TOTAL</h6>
            <h6 class="right">Rs. <?php echo $cart_total ?></h6>

        </div>

    </div>
    <div class="col s12 m6">

    </div>

</div>



<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>