<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);
date_default_timezone_set('Asia/Kolkata');
$added_on = date('Y-m-d h:i:s');

$sql =  "SELECT * FROM users WHERE email='$email' AND password='$password'";
$res = mysqli_query($con, $sql);
$check_user = mysqli_num_rows($res);

if ($check_user > 0) {
    $row = mysqli_fetch_assoc($res);
    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME'] = $row['name'];
    if (isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID'] != '') {
        wishlist_add($con, $_SESSION['USER_ID'], $_SESSION['WISHLIST_ID']);
        unset($_SESSION['WISHLIST_ID']);
    }
    echo "valid";
} else {
    echo 'wrong';
}
