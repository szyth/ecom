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
        case "product":
            getProduct($con);
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

function getProduct($con) {
    $msg = "";
    if (isset($_POST['p_id'])) {
        $p_id = get_safe_value($con, $_POST['p_id']);
        $msg = $p_id == "" ? "Invalid Request. Please enter a valid Product ID" : "";

        if ($msg == "") {
            $arr = [];

            $query = "SELECT * FROM product_new WHERE id = " . $p_id;
            $res = mysqli_query($con, $query);
            $productRow = mysqli_fetch_assoc($res);

            $query = "SELECT * FROM product_images WHERE super_id = " . $productRow['image_super_id'];
            $res = mysqli_query($con, $query);

            $i = 0;
            while ($row = mysqli_fetch_assoc($res)) {
                $mediaArr[$i] = $row;
                $i++;
            }
            $productRow['media'] = $mediaArr;


            $msg = json_encode($productRow);
        }

        echo $msg;

    } else {
        echo "Please enter a valid product ID";
    }
}
