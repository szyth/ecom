<?php
// require('connection.inc.php');
function pr($arr) {
    echo '<pre>';
    print_r($arr);
}

function prx($arr) {
    echo '<pre>';
    print_r($arr);
    die();
}

//custom function to get products
function get_product($con,$type='',$limit='') {

    $sql = "SELECT * FROM product WHERE status=1";

    if($type=='latest'){
        $sql.=" ORDER BY id DESC";
    }
    if($limit!=''){
        $sql.=" LIMIT $limit";
    }


    $res = mysqli_query($con,$sql);
    $data = array();
    while($row=mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}

?>