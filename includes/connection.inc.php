<?php

session_start();

//CONNECTION STRING, USE this on CLASSI SERVER
//FTP: classycloset.onebigbit.com classycloset !sa6pT12
$con = mysqli_connect("localhost", "classy_closet", "O33y*ee3", "classy_closet");


//CONNECTION STRING, USE this on local machine
// $con = mysqli_connect("localhost", "root", "", "ecom");

//CONNECTION STRING, USE this on PLESK classicloset.com
// $con = mysqli_connect("localhost", "classicloset", "Gg75b!t4", "classicloset");





//CONNECTION STRING, USE THIS ON 000WEBHOST
// $con = mysqli_connect("localhost", "id14556290_root", "Ziaur@8574803737", "id14556290_ecom"); FOR obb-ecom 000WEBHOST





if (mysqli_connect_errno()) {
    echo "Connection could not be established..." . mysqli_connect_error();
}
