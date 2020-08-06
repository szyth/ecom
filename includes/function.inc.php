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
        $sql .= " product.LIMIT $limit";
    }


    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}
