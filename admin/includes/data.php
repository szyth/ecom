<?php
require('connection.inc.php');

if (isset($_POST['sid'])) {
    $sid = $_POST['sid'];

    $res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id ='$sid'");

    $arr = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}
