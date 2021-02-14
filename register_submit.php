<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$name = get_safe_value($con, $_POST['name']);
$email = get_safe_value($con, $_POST['email']);
$mobile = get_safe_value($con, $_POST['mobile']);
$password = get_safe_value($con, $_POST['password']);
date_default_timezone_set('Asia/Kolkata');
$added_on = date('Y-m-d h:i:s');


$sql = "SELECT * FROM users WHERE email='$email'";
$check_user = mysqli_num_rows(mysqli_query($con, $sql));

if ($check_user > 0) {
    echo "wrong";
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "INSERT INTO users(name,password,email,mobile,added_on) VALUES ('$name','$hashed_password','$email','$mobile','$added_on')");

    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = mysqli_insert_id($con);
    $_SESSION['USER_NAME'] = $name;
    if (isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID'] != '') {
        wishlist_add($con, $_SESSION['USER_ID'], $_SESSION['WISHLIST_ID']);
        unset($_SESSION['WISHLIST_ID']);
    }
    echo 'valid';
}
