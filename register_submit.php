<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$name = get_safe_value($con, $_POST['name']);
$email = get_safe_value($con, $_POST['email']);
$mobile = get_safe_value($con, $_POST['mobile']);
$password = get_safe_value($con, $_POST['password']);
$added_on = date('Y-m-d h:i:s');

$check_user = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='$email'"));

if ($check_user > 0) {
    echo "Email already exists";
} else {
    mysqli_query($con, "INSERT INTO users(name,password,email,mobile,added_on) VALUES ('$name','$password','$email','$mobile','$added_on')");
    echo 'Thank You!';
}
