<?php
// require('connection.inc.php');
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($con, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($con, $str);
    }
}

//custom function to get products
function get_product($con, $limit = '', $cat_id = '', $product_id = '')
{

    $data = array();
    $sql = "SELECT product_new.*,categories.categories FROM product_new,categories WHERE product_new.status=1";

    if ($cat_id != '') {
        $sql .= " AND product_new.subcat_id=$cat_id";
    }
    if ($product_id != '') {
        $sql .= " AND product_new.id=$product_id";
    }

    $sql .= " AND product_new.subcat_id=categories.id";
    $sql .= " ORDER BY product_new.id DESC";

    if ($limit != '') {
        $sql .= " LIMIT $limit";
    }


    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {


        $image_super_id = $row['image_super_id'];
        $image = "SELECT `name` AS `image` FROM product_images WHERE product_images.super_id=$image_super_id";
        $res_image = mysqli_query($con, $image);
        $row_image = mysqli_fetch_assoc($res_image);
        $row['image'] =  $row_image['image'];


        $data[] = $row;
    }
    return $data;
}


function wishlist_add($con, $uid, $pid)
{
    date_default_timezone_set('Asia/Kolkata');
    $added_on = date('Y-m-d h:i:s');
    mysqli_query($con, "insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
}
