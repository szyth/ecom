<?php
require('connection.inc.php');
require('function.inc.php');

$errorMsg = "Invalid API call. Please enter a valid target";

if (isset($_POST['target'])) {
    $target = $_POST['target'];

    switch ($target) {
        case "address":
            getAddress($con);
            break;
        case "addressRadio":
            getAddress($con);
            break;
        default:
            echo $errorMsg;
    }
} else {
    echo $errorMsg;
}

function getAddress($con)
{
    $uid = $_SESSION['USER_ID'];
    $res = mysqli_query($con, "SELECT * FROM `address` WHERE `user_id`=$uid");

    $arr = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}
