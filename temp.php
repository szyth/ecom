<?php

$cart_total = 0;
foreach ($_SESSION['cart'] as $key => $val) {
    $productAr = get_product($con, '', '', $key);
    $price = $_SESSION['cart'][$key]['price'];
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
    date_default_timezone_set(
        'Asia/Kolkata'
    );
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
} ?>