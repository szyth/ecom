<?php

require('connection.inc.php');
require('function.inc.php');
require('add_to_cart.inc.php');


$super_cat_res = mysqli_query($con, "SELECT * FROM super_category WHERE status=1 ORDER BY super_category ASC");

$super_cat_arr = array();
while ($row = mysqli_fetch_assoc($super_cat_res)) {
    $super_cat_arr[] = $row;
}

$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();

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

                        <?php
                        foreach ($super_cat_arr as $list) {
                        ?>
                            <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['super_category'] ?></a></li>

                        <?php
                        }
                        ?>

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
                        <li id="search_icon"><a> <i class="material-icons-outlined">search</i></a> </li>
                        <li id="nav_cart">
                            <div class="htc__shopping__cart">
                                <a class="cart__menu" href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a>
                                <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                            </div>

                        </li>
                        <li> <?php
                                if (isset($_SESSION['USER_LOGIN'])) {
                                    echo '<a href="logout.php">' . $_SESSION['USER_NAME'] . '&#9662;</a></li> <li><a href="my_order.php">Orders</a>';
                                } else {
                                    echo '<a href="login.php">Login</a>';
                                }
                                ?>
                        </li>
                        <!-- <li><a href="contact.php">Contact</a></li> -->



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
                        <?php
                        foreach ($super_cat_arr as $list) {
                        ?>
                            <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['super_category'] ?></a></li>

                        <?php
                        }
                        ?>
                    </ul>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><?php
                        if (isset($_SESSION['USER_LOGIN'])) {
                            echo '<a href="logout.php">Logout</a>';
                        } else {
                            echo '<a href="login.php">Login</a>';
                        }
                        ?>
                    </li>
                </ul>
                <a href="#" data-target="nav-mobile" class="left sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right sidenav-trigger">
                    <li> <a href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a></li>
                    <li id="search_icon_mobile"><a> <i class="material-icons-outlined">search</i></a> </li>

                </ul>


                <!-- <a href="#"><span class="htc__qua">0</span></a> -->
            </div>
        </nav>
        <!-- <div style="background-color: #fff;" class="row ">
            <div class="col s8 offset-s2">
                <div class="input-field black-text">
                    <input placeholder="Search here" id="first_name" type="text" class="validate">
                </div>
            </div>
        </div> -->
        <div id="index_search" class="row" style="background-color: #fff;">
            <form method="POST" action="search.php" id="search_form">
                <div class="row">
                    <div class="col s2 left">
                        <div id="back_button_mobile" class="hide-on-large-only waves-effect waves-light  btn-flat btn-large center">
                            <i class="material-icons-outlined left">keyboard_backspace</i>
                        </div>
                    </div>
                    <div class="input-field col s8 m7">

                        <input id="search" placeholder="Search for products and more " name="search" type="text" class="validate">
                        <!-- <label for="search" style="color: #9e9e9e;">Search for products and more </label> -->
                    </div>
                    <div class="col s2 m2">
                        <button type="submit" name="submit" id="search_button" class="hide-on-med-and-down waves-effect waves-light btn-large btn-flat ">
                            <i class="material-icons-outlined">search</i>Search
                        </button>
                        <button type="submit" name="submit" id="search_button_mobile" class="hide-on-large-only waves-effect waves-light btn-large btn-flat right">
                            <i class="material-icons-outlined">search</i>
                        </button>

                    </div>
                </div>

            </form>
        </div>

    </div>