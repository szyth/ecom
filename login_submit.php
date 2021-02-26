<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);
date_default_timezone_set('Asia/Kolkata');
$added_on = date('Y-m-d h:i:s');

$check_user = 0;
$res = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
$row =  mysqli_fetch_assoc($res);
if (mysqli_num_rows($res)) {
    $hashed_password = $row['password'];
    if (password_verify($password, $hashed_password)) {
        $check_user = mysqli_num_rows($res);
    }
}




if ($check_user > 0) {
    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME'] = $row['name'];

    //fetch cart data from db
    $user_id = $row['id'];
    $res = mysqli_query($con, "SELECT * FROM cart WHERE user_id=$user_id");
    if (mysqli_num_rows($res)) {
        while ($cart = mysqli_fetch_assoc($res)) {
            $product_id = $cart['product_id'];
            $get_product = get_product($con, '', '', $product_id);
            $qty = $cart['qty'];
            $mrp = $get_product[0]['mrp'];

            $price = 0;
            if ($get_product['0']['discount_type'] == 'rate') {
                $price = ($get_product['0']['mrp'] - $get_product['0']['discount']);
            } elseif ($get_product['0']['discount_type'] == 'percent') {
                $price = ($get_product['0']['mrp'] - (($get_product['0']['discount'] * $get_product['0']['mrp']) / 100));
            } else {
                $price = $get_product['0']['mrp'];
            }
            $_SESSION['cart'][$product_id]['qty'] = $qty;
            $_SESSION['cart'][$product_id]['price'] = $price;
        }
    }



    if (isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID'] != '') {
        wishlist_add($con, $_SESSION['USER_ID'], $_SESSION['WISHLIST_ID']);
        unset($_SESSION['WISHLIST_ID']);
    }
    echo "valid";
} else {
    echo 'wrong';
}
