<?php

$product = $_POST['product'];
$colors = $_POST['colors'];
$product = json_decode($product, true);
$colors = json_decode($colors, true);

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

prx($product);
prx($colors);

echo true;
