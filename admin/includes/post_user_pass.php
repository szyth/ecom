<?php
require('connection.inc.php');
require('functions.inc.php');

$newpass = $_POST['newpass'];
$cnewpass = $_POST['cnewpass'];
if ($newpass == $cnewpass) {
    $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
    $user_id = $_SESSION['ADMIN_ID'];
    mysqli_query($con, "UPDATE admin_users SET `password`='$hashed_password' WHERE id='$user_id'");
    echo 'Password Changed Successfully';
} else {
    echo 'Error Changing Password';
}
