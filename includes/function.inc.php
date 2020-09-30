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
    $sql = "SELECT product.*,categories.categories FROM product,categories WHERE product.status=1";

    if ($cat_id != '') {
        $sql .= " AND product.categories_id=$cat_id";
    }
    if ($product_id != '') {
        $sql .= " AND product.id=$product_id";
    }

    $sql .= " AND product.categories_id=categories.id";
    $sql .= " ORDER BY product.id DESC";

    if ($limit != '') {
        $sql .= " LIMIT $limit";
    }


    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
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
