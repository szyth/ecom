<?php
require('includes/connection.inc.php');

$user_id = $_SESSION['USER_ID'];
if (!empty($_SESSION['cart'])) {
    mysqli_query($con, "DELETE FROM `cart` WHERE user_id=$user_id");
    foreach ($_SESSION['cart'] as $pid => $val) {
        $product_id = $pid;
        $qty = $val['qty'];
        mysqli_query($con, "INSERT INTO `cart`(`user_id`, `product_id`, `qty`) VALUES ($user_id,$product_id,$qty)");
    }
}






unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['cart']);
?>
<script>
    location.replace("index.php");
</script>
<?php
die();
?>