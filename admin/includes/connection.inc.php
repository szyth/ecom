<?php

session_start();

//CONNECTION STRING, USE this on CLASSI SERVER
//FTP: classycloset.onebigbit.com classycloset !sa6pT12
// $con = mysqli_connect("localhost", "classy_closet", "O33y*ee3", "classy_closet");



//CONNECTION STRING, USE this on local machine
// $con = mysqli_connect("localhost", "root", "", "ecom");



//CONNECTION STRING, USE this on PLESK classicloset.com
$con = mysqli_connect("localhost", "classicloset", "Gg75b!t4", "classicloset");


if (mysqli_connect_errno()) {
    echo "Connection could not be established..." . mysqli_connect_error();
}
