<?php require('includes/header.inc.php');
if (!isset($_SESSION['USER_LOGIN']) || empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php
}

if (isset($_POST['addressForm'])) {
    $uid = $_SESSION['USER_ID'];
    $name = get_safe_value($con, $_POST['name']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $address = get_safe_value($con, $_POST['address']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $city = get_safe_value($con, $_POST['city']);

    date_default_timezone_set('Asia/Kolkata');
    $added_on = date('Y-m-d h:i:s');
    $sql = "INSERT INTO `address`(`user_id`, `name`, `mobile`, `address`, `pincode`, `city`, `added_on`) VALUES ('$uid','$name','$mobile','$address','$pincode','$city','$added_on')";
    mysqli_query($con, $sql);
}

?>

<div class="divider"></div>
<div class="row">
    <div class="col s10 offset-s1 m5 offset-m1">
        <!-- ADDRESS DETAILS -->
        <div id="address_details" class="title center">
            <h1 style="margin-top: 1.8rem !important;">My Saved Address</h1>
        </div>

        <!-- populating address in Radio  -->
        <div>
            <form class="addressListRadio">
            </form>
        </div>

        <br>
        <a id="addAddress" class="waves-effect waves-light btn btn-small btn-flat white-text blue lighten-1 modal-trigger" href="#addressModal">Add new address</a>
        <a class="waves-effect waves-light btn btn-small btn-flat white-text red lighten-2" href="user_profile.php">Manage addresses</a>
        <!-- modal structure -->
        <div id="addressModal" class="modal">
            <div class="modal-content">
                <h4>New Address Details</h4>
                <form id="address_form" method="POST">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="&nbsp;Full Name" id="name" name="name" type="text" class="validate" data-length="30">
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="&nbsp;Mobile No." id="mobile" name="mobile" type="tel" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="&nbsp;Address" id="address" name="address" type="text" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="&nbsp;Pincode" id="pincode" name="pincode" type="number" class="validate">
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="&nbsp;City / State" id="city" name="city" type="text" class="validate">
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <a class="modal-close waves-effect waves-green btn blue white-text"> -->
                <input type="submit" name="addressForm" value="Submit" form="address_form">
                <!-- </a> -->
            </div>
        </div>

        <!-- ADDRESS DETAILS - END -->
    </div>
    <div class="col s10 offset-s1 m4 offset-m1">
        <!-- PAYMENT MODE -->
        <div id="payment_mode" class="title">
            <h1 class="center">Payment Mode</h1>
            <form>
                <p>
                    <label>
                        <input name="group2" data-value="cod" type="radio" checked />
                        <span>Cash On Delivery</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="group2" data-value="online" type="radio" />
                        <span>RazorPay</span>
                    </label>
                </p>
            </form>
        </div>

        <!-- PAYMENT MODE - END -->
        <!-- ORDER DETAILS  -->
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
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <?php
                $cart_total = 0;
                foreach ($_SESSION['cart'] as $key => $val) {
                    $productAr = get_product($con, '', '', $key);
                    $pname = $productAr[0]['name'];
                    $mrp = $productAr[0]['mrp'];
                    $price = $_SESSION['cart'][$key]['price'];
                    $image = $productAr[0]['image'][0];
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
                            <td><?php echo $qty ?></td>
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
                <input type="submit" name="submit" id="submit" value="Place Order">
                <!-- <input type="submit" name="submit" id="rzp-button1" value=" Order"> -->
            </div>
        </div>
    </div>
    <!-- ORDER DETAILS - END -->
</div>



<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>