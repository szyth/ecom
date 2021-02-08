<?php

session_start();
// $con = mysqli_connect("localhost", "root", "", "ecom");
// $con = mysqli_connect("localhost", "id14556290_root", "Ziaur@8574803737", "id14556290_ecom"); FOR obb-ecom 000WEBHOST

// classycloset.onebigbit.com classycloset !sa6pT12
$con = mysqli_connect("localhost", "classy_closet", "O33y*ee3", "classy_closet");


if (mysqli_connect_errno()) {
    echo "Connection could not be established..." . mysqli_connect_error();
}
