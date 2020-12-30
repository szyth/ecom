<?php
require('connection.inc.php');
require('functions.inc.php');

$errorMsg = "Invalid API call. Please enter a valid target";

if (isset($_POST['target'])) {
    $target = $_POST['target'];

    switch($target) {
        case "size": 
            getSize($con);
            break;
        case "subcategory":
            getSubcategory($con);
            break;
        case "color":
            getColor($con);
            break;
        case "category":
            getCategory($con);
            break;
        default:
            echo $errorMsg;
    }
} else {
    echo $errorMsg;
}

function getSize($con) {
    $res = mysqli_query($con, "SELECT * FROM product_size");

    $arr = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);

}

function getSubcategory($con) {
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];

        $res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id ='$cat_id'");

        $arr = [];
        $i = 0;

        while ($row = mysqli_fetch_assoc($res)) {
            $arr[$i] = $row;
            $i++;
        }

        echo json_encode($arr);
    }
}

function getColor($con) {
    $res = mysqli_query($con, "SELECT * FROM product_color");

    $arr = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}
