<?php

require('connection.inc.php');
require('function.inc.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>OBB - ECOM</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>


<body>
    <div class="">
        <nav class="white z-depth-0" role="navigation">
            <div class="row">
                <div class="col s12 m3 center">
                    <a id="logo-container" class="brand-logo" href="index.php">CLASSY CLOSET</a>
                </div>
                <div class="col s12 m6 push-custom">
                    <ul class="hide-on-med-and-down nav-ul">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="categories.php">Kid's</a></li>
                        <li><a href="categories.php">Women's</a></li>
                        <li><a href="categories.php">Men's</a></li>
                        <!-- dropdown -->
                        <!-- <li id="dropdown"><a href="#">Categories &#9662;</a>
                        <ul class="dropdown">
                            <li><a href="categories.html">Kids &#9656;</a></li>
                            <li><a href="categories.html">Women's &#9656;</a></li>
                            <li><a href="categories.html">Men's &#9656;</a></li>
                        </ul>
                    </li> -->

                    </ul>
                </div>

                <div class="col s12 m3">
                    <ul class="hide-on-med-and-down nav-ul">
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li id="nav_cart"><a href="#"> <i class="material-icons-outlined">shopping_cart</i>
                            </a></li>
                    </ul>

                </div>

                <!-- MOBILE MENU -->
                <ul id="nav-mobile" class="sidenav">
                    <li><a href="index.php">Home</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a class="subheader">Categories</a></li>
                    <ul>
                        <li><a href="categories.php">Kids</a></li>
                        <li><a href="categories.php">Women's</a></li>
                        <li><a href="categories.php">Men's</a></li>
                    </ul>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="left sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="cart.html" class="right sidenav-trigger"><i class="material-icons-outlined">shopping_cart</i></a>
            </div>
        </nav>

    </div>