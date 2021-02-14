<?php
require('connection.inc.php');
require('function.inc.php');

$oldpass = $_POST['oldpass'];

$user_id = $_SESSION['USER_ID'];
$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'"));
$hashed_password = $row['password'];
if (password_verify($oldpass, $hashed_password)) {
    echo $oldpass;
}
