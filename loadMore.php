<?php

require('includes/connection.inc.php');
require('includes/function.inc.php');


$row = $_POST['row'];
$productperpage = 8;

// selecting posts
$data = array();
$sql = 'SELECT * FROM product_new WHERE status=1 ORDER BY id DESC limit ' . $row . ',' . $productperpage;

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
// return $data;

echo json_encode($data);

// $html = '';

// while ($row = mysqli_fetch_array($result)) {
//     $id = $row['id'];
//     $title = $row['name'];
//     $content = $row['description'];
//     $shortcontent = substr($content, 0, 160) . "...";
//     $link = $row['image_super_id'];
//     // Creating HTML structure
//     $html .= '<h1>' . $title . '</h1>';
//     $html .= '<p>' . $shortcontent . '</p>';
//     $html .= '<a href="' . $link . '" target="_blank" class="more">More</a>';
//     $html .= '</div>';
// }

// echo $html;
