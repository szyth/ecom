<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$type = get_safe_value($con, $_POST['type']);

if ($type == "remove") {
    mysqli_query($con, "DELETE FROM wishlist WHERE product_id=$pid");
    echo "remove";
} else {
    if (isset($_SESSION['USER_LOGIN'])) {
        $uid = $_SESSION['USER_ID'];
        if (mysqli_num_rows(mysqli_query($con, "select * from wishlist where user_id='$uid' and product_id='$pid'")) > 0) {
            //echo "Already added";
        } else {
            wishlist_add($con, $uid, $pid);
        }
        // echo $total_record = mysqli_num_rows(mysqli_query($con, "select * from wishlist where user_id='$uid'"));
    } else {
        $_SESSION['WISHLIST_ID'] = $pid;
        echo "not_login";
    }
}
