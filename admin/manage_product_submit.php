<?php
require('includes/connection.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
    header('location:login.php');
    die();
}
print_r($_FILES);

$product = $_POST['product'];
$colors = $_POST['colors'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];

$product = json_decode($product, true);
$colors = json_decode($colors, true);
//inserting in product table
$sql = "INSERT INTO product(categories_id,name,description,status,added_by) VALUES('$category','" . $product['name'] . "','" . $product['description'] . "','1','" . $_SESSION['ADMIN_ID'] . "')";
mysqli_query($con, $sql);
$product_id =  mysqli_insert_id($con);
//inserting in variantDetails table
foreach ($colors as $color) {
    if (isset($color['sizes']['s'])) {
        $S = $color['sizes']['s'];
    } else {
        $S = 0;
    }
    if (isset($color['sizes']['m'])) {
        $M = $color['sizes']['m'];
    } else {
        $M = 0;
    }
    if (isset($color['sizes']['l'])) {
        $L = $color['sizes']['l'];
    } else {
        $L = 0;
    }
    if (isset($color['sizes']['xl'])) {
        $XL = $color['sizes']['xl'];
    } else {
        $XL = 0;
    }

    mysqli_query($con, "INSERT INTO variantDetails ( `product_id`, `color`, `mrp`, `price`, `S`, `M`, `L`, `XL`) VALUES ('$product_id','" . $color['color'] . "','" . $color['mrp'] . "','" . $color['price'] . "','$S','$M','$L','$XL')");

    $color_id =  mysqli_insert_id($con);
    foreach ($color['media'] as $image) {
        print_r($_FILES);
        $destFile = "../media/product" . $image;
        $moved = move_uploaded_file($image, $destFile);
        // if ($moved) {
        //     echo "Image uploaded";
        // } else {
        //     echo "Not uploaded because of error #";
        // }
        mysqli_query($con, "INSERT INTO `variantImages`(`color_id`, `image`) VALUES ('$color_id','$image')");
    }
}
echo mysqli_error($con);

if (empty(mysqli_error($con))) {
    echo "Successfully uploaded";
} else {
    echo mysqli_error($con);
}
// print_r($subcategory);
