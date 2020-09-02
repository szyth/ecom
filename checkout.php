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

$cart_total = 0;
foreach ($_SESSION['cart'] as $key => $val) {
    $productAr = get_product($con, '', '', $key);
    $price = $productAr[0]['price'];
    $qty = $val['qty'];
    $cart_total = $cart_total + ($price * $qty);
}


if (isset($_POST['submit'])) {
    $user_id = $_SESSION['USER_ID'];
    $name = get_safe_value($con, $_POST['name']);
    $number = get_safe_value($con, $_POST['number']);
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $payment_type = 'cod';
    $total_price = $cart_total;
    if ($payment_type == 'cod') {
        $payment_status = 'success';
    }
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');


    $sql = "INSERT INTO `orders`(user_id,name,number,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$name','$number','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')";
    mysqli_query($con, $sql);

    $order_id = mysqli_insert_id($con);
    foreach ($_SESSION['cart'] as $key => $val) {
        $productAr = get_product($con, '', '', $key);
        $price = $productAr[0]['price'];
        $qty = $val['qty'];

        mysqli_query($con, "INSERT INTO `order_detail`(order_id, product_id, qty, price) values('$order_id','$key','$qty','$price')");
    }

    unset($_SESSION['cart']);
?>
    <script>
        window.location.href = 'thankyou.php'
    </script>
<?php
}
?>

<div class="divider"></div>



<div class="row">
    <div class="col s10 offset-s1 m5 offset-m1">
        <form id="address_form" method="POST">
            <div class="row">
                <div id="address_details" class="title center">
                    <h1>Address Details</h1>
                </div>
                <div class="input-field col s6">
                    <input placeholder="&nbsp;Full Name" id="name" name="name" type="text" class="validate">
                </div>
                <div class="input-field col s6">
                    <input placeholder="&nbsp;Mobile No." id="number" name="number" type="tel" class="validate">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="&nbsp;Address" id="address" name="address" type="text" class="validate">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="&nbsp;City" id="city" name="city" type="text" class="validate">
                </div>
                <div class="input-field col s6">
                    <input placeholder="&nbsp;Pincode" id="pincode" name="pincode" type="text" class="validate">
                </div>
            </div>
        </form>
        <div id="payment_mode" class="title center">
            <h1>Payment Mode</h1>
            <br>
            <h5 style="border: solid #444 1px; padding: 5px; color:#444">Cash on Delivery</h5>
        </div>
    </div>
    <div class="col s10 offset-s1 m4 offset-m1">
        <div class=" center">
            <div id="order_details" class="title center">
                <h1>Order Details</h1>
            </div>
            <div class="divider"></div>
            <table class="highlight centered " id="cart">
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

            <br>
            <br>
            <br>
            <br>

            <div id="address_form_submit">
                <input type="submit" name="submit" value="Place Order" form="address_form">
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