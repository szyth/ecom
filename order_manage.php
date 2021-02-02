 <?php
    require('includes/connection.inc.php');
    require('includes/function.inc.php');
    if (!isset($_SESSION['USER_LOGIN']) || empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    ?>
     <script>
         window.location.href = 'index.php'
     </script>
 <?php
    }

    if (isset($_POST['address_id']) && isset($_POST['payment_type'])) {


        $cart_total = 0;
        foreach ($_SESSION['cart'] as $key => $val) {
            $productAr = get_product($con, '', '', $key);
            $price = $_SESSION['cart'][$key]['price'];
            $qty = $val['qty'];
            $cart_total = $cart_total + ($price * $qty);
        }
        $user_id = $_SESSION['USER_ID'];
        $address_id = $_POST['address_id'];
        $payment_type = 'cod';
        $total_price = $cart_total;
        $payment_status = 'success';
        $order_status = '1';
        date_default_timezone_set(
            'Asia/Kolkata'
        );
        $added_on = date('Y-m-d h:i:s');

        $sql = "INSERT INTO `orders`(`user_id`, `address_id`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) values('$user_id','$address_id','$payment_type','$total_price','$payment_status','$order_status','$added_on')";
        mysqli_query($con, $sql);


        $order_id = mysqli_insert_id($con);
        foreach ($_SESSION['cart'] as $key => $val) {
            $productAr = get_product($con, '', '', $key);
            $price = $_SESSION['cart'][$key]['price'];
            $qty = $val['qty'];

            mysqli_query($con, "INSERT INTO `order_detail`(`order_id`, `product_id`, `qty`, `price`) values('$order_id','$key','$qty','$price')");

            $qtyinDB = $productAr[0]['quantity'] - $qty;
            $product_id = $productAr[0]['id'];
            mysqli_query($con, "UPDATE `product_new` SET `quantity`=$qtyinDB WHERE `id`=$product_id");
        }

        unset($_SESSION['cart']);
        echo 'success';
    }
