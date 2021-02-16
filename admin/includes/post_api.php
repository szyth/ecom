<?php
require('connection.inc.php');
require('functions.inc.php');

$errorMsg = "Invalid API call. Please enter a valid target";

if (isset($_POST['target'])) {
    $target = $_POST['target'];

    switch ($target) {
        case "size":
            addSize($con);
            break;
        case "subcategory":
            addSubcategory($con);
            break;
        case "color":
            addColor($con);
            break;
        case "products":
            addProducts($con);
            break;
        default:
            echo $errorMsg;
    }
} else {
    echo $errorMsg;
}

function addSize($con)
{
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

function addSubcategory($con)
{
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

function addColor($con)
{
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

function addProducts($con)
{
    // @param: target and data
    $msg = "";
    if (isset($_POST["data"])) {
        $data = $_POST["data"];

        $pdo = new PDO(
            "mysql:host=localhost;dbname=classy_closet",
            "classy_closet",
            "O33y*ee3",
            // $pdo = new PDO(
            //     "mysql:host=localhost;dbname=ecom",
            //     "root",
            //     "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );

        $pdo->beginTransaction();

        $res = $pdo->query("SELECT MAX(parent_id) FROM product_new");
        $row = $res->fetch(PDO::FETCH_NUM);
        $parent_p_id = $row[0];
        $parent_p_id = $parent_p_id == "" ? 1 : $parent_p_id + 1;

        try {
            foreach ($data as $datum) {
                $product = json_decode(json_encode($datum), false);

                if (!isset($product->image_super_id)) {
                    $res = $pdo->query("SELECT MAX(super_id) FROM product_images");
                    $row = $res->fetch(PDO::FETCH_NUM);
                    $image_p_id = $row[0];
                    $image_p_id = $image_p_id == "" ? 1 : $image_p_id + 1;
                } else {
                    $p_id = $product->id;
                    $parent_p_id = $product->parent_id;
                    $image_p_id = $product->image_super_id;
                    $res = $pdo->query("DELETE FROM product_images WHERE super_id = '$image_p_id'");
                }


                $imageCount = $product->imageCount;
                while ($imageCount > 0) {
                    $imageName = $product->{"image_" . ($imageCount)};
                    $pdo->query("INSERT INTO product_images(super_id, name) VALUES('$image_p_id', '$imageName')");
                    $imageCount--;
                }

                $articleID = isset($product->articleid) ? $product->articleid : "";

                $discType = $product->{"discount-type"};
                if (isset($product->id)) {
                    if ($discType == "none") {
                        $pdo->query("UPDATE product_new SET cat_id='$product->cat', subcat_id='$product->subcat', name='$product->name', description='$product->desc', color='$product->color', size='$product->size', mrp='$product->mrp', article_id='$articleID', quantity='$product->quantity', image_super_id='$image_p_id', discount_type='$discType', added_by='" . $_SESSION['ADMIN_ID'] . "' WHERE id='$p_id'");
                    } else {
                        $pdo->query("UPDATE product_new SET cat_id='$product->cat', subcat_id='$product->subcat', name='$product->name', description='$product->desc', color='$product->color', size='$product->size', mrp='$product->mrp', discount='$product->discount', article_id='$articleID', quantity='$product->quantity', image_super_id='$image_p_id', discount_type='$discType', added_by='" . $_SESSION['ADMIN_ID'] . "' WHERE id='$p_id'");
                    }
                } else {
                    if ($discType == "none") {
                        $pdo->query("INSERT INTO product_new(parent_id, cat_id, subcat_id, name, description, color, size, mrp, article_id, quantity, image_super_id, discount_type,added_by) VALUES ('$parent_p_id', '$product->cat', '$product->subcat', '$product->name', '$product->desc', '$product->color', '$product->size', '$product->mrp', '$articleID', '$product->quantity', '$image_p_id', '$discType','" . $_SESSION['ADMIN_ID'] . "')");
                    } else {
                        $pdo->query("INSERT INTO product_new(parent_id, cat_id, subcat_id, name, description, color, size, mrp, discount, article_id, quantity, image_super_id, discount_type,added_by) VALUES ('$parent_p_id', '$product->cat', '$product->subcat', '$product->name', '$product->desc', '$product->color', '$product->size', '$product->mrp', '$product->discount', '$articleID', '$product->quantity', '$image_p_id', '$discType','" . $_SESSION['ADMIN_ID'] . "')");
                    }
                }
            }
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            $msg =  "Something went wrong. " . $e->getMessage();
        }

        $msg = $msg == "" ? "Product Added Successfully" : $msg;
    } else {
        $msg = "Incomplete API request";
    }
    echo $msg;
}
