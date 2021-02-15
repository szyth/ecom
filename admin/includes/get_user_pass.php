<?php
require('connection.inc.php');
require('functions.inc.php');

$oldpass = $_POST['oldpass'];

$user_id = $_SESSION['ADMIN_ID'];
$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_users WHERE id='$user_id'"));
$hashed_password = $row['password'];
if (password_verify($oldpass, $hashed_password)) {
    echo $oldpass;
}
