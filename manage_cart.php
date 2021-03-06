<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');
require('includes/add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$qty = get_safe_value($con, $_POST['qty']);
$type = get_safe_value($con, $_POST['type']);
$price = get_safe_value($con, $_POST['price']);

$obj = new add_to_cart();

if ($type == 'add') {
    $obj->addProduct($pid, $qty, $price);
}
if ($type == 'remove') {
    $obj->removeProduct($pid);
}

if ($type == 'update') {
    $obj->updateProduct($pid, $qty);
}

echo $obj->totalProduct();
