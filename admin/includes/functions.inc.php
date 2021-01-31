<?php

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


function isAdmin()
{
    if (!isset($_SESSION['ADMIN_LOGIN'])) {
?>
        <script>
            window.location.href = 'login.php'
        </script>
    <?php
    }
    if ($_SESSION['ADMIN_ROLE'] == 1) {
    ?>
        <script>
            window.location.href = 'product.php'
        </script>
<?php
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

        $i = 0;
        $image_super_id = $row['image_super_id'];
        $image = "SELECT `name` AS `image` FROM product_images WHERE product_images.super_id=$image_super_id";
        $res_image = mysqli_query($con, $image);
        while ($row_image = mysqli_fetch_assoc($res_image)) {
            $row['image'][$i++] =  $row_image['image'];
        }


        $data[] = $row;
    }
    return $data;
}
?>