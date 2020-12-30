<?php
require('connection.inc.php');
require('functions.inc.php');

$errorMsg = "Invalid API call. Please enter a valid target";

if (isset($_POST['target'])) {
    $target = $_POST['target'];

    switch($target) {
        case "size": 
            addSize($con);
            break;
        case "subcategory":
            addSubcategory($con);
            break;
        case "color":
            addColor($con);
            break;
        default:
            echo $errorMsg;
    }
} else {
    echo $errorMsg;
}

function addSize($con) {
    // @param: target, value and name
    if (isset($_POST['value']) && isset($_POST['name'])) {
        $value = get_safe_value($con, $_POST['value']);
        $name = get_safe_value($con, $_POST['name']);
        $query = "SELECT value FROM product_size WHERE value='$value'";
        $msg = "";

        if ($value == "" || $name == "")
            $msg = "Incomplete request";        

        $res = mysqli_query($con, $query);
        $check = mysqli_num_rows($res);

        if ($check < 1 && $msg == "") {
            $updateQuery = " INSERT INTO product_size(value, name) VALUES ('$value','$name')";
            $result = mysqli_query($con, $updateQuery);

            $msg = $result == TRUE ? "Size added successfully" : "Action failed. Please try again";

        } else {
            $msg = "Size already exists";
        }

    } else {
        $msg = "Incomplete request";
    }
    echo $msg;

}

function addSubcategory($con) {
    // @param: target, value and super_categories_id
    if (isset($_POST['value']) && isset($_POST['super_categories_id'])) {
        $value = get_safe_value($con, $_POST['value']);
        $super_categories_id = get_safe_value($con, $_POST['super_categories_id']);
        $msg = "";

        if ($value == "" || $super_categories_id == "")
            $msg = "Incomplete request";

        if ($msg == "") {
            $sql = "SELECT * FROM super_category";
            $res = mysqli_query($con, $sql);
            $i = 0;
            $arr = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[$i++] = $row['id'];
            }
            if (!in_array($super_categories_id, $arr))
                $msg = "Invalid Category";
        }

        if ($msg == "") {
            $sql = "SELECT * FROM categories WHERE super_categories_id = '$super_categories_id'";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                if (strcasecmp($row['categories'], $value) == 0) {
                    $msg = "Category already exists";
                    break;
                }
            }
        }

        if ($msg == "") {
            $sql = "INSERT INTO categories(super_categories_id,categories,status) VALUES ('$super_categories_id','$value', '1')";
            $result = mysqli_query($con, $sql);
            $msg = $result == TRUE ? "Subcategory added successfully" : "Action failed. Please try again";
        }

    } else {
        $msg = "Incomplete request";
    }

    echo $msg;
}

function addColor($con) {
    // @param: target, value and name
    if (isset($_POST['value']) && isset($_POST['name'])) {
        $value = get_safe_value($con, $_POST['value']);
        $name = get_safe_value($con, $_POST['name']);
        $msg = "";

        if ($value == "" || $name == "")
            $msg = "Incomplete request";

        if ($msg == "") {
            $query = "SELECT value FROM product_color WHERE value='$value'";
            $res = mysqli_query($con, $query);
            $check = mysqli_num_rows($res);

            if ($check < 1) {
                $updateQuery = " INSERT INTO product_color(value, name) VALUES ('$value','$name')";
                $result = mysqli_query($con, $updateQuery);

                $msg = $result == TRUE ? "Color added successfully" : "Action failed. Please try again";

            } else {
                $msg = "Color already exists";
            }
        }        

    } else {
        $msg = "Incomplete request";
    }
    echo $msg;
}
