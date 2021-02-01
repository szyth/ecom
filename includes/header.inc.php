<?php

require('connection.inc.php');
require('function.inc.php');
require('add_to_cart.inc.php');

$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBB - ECOM</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>




<!-- <ul>
    <li class="mega-drop-down hide-on-med-and-down"><a href=" #">Categories</a>
        <div class="animated fadeIn mega-menu">
            <div class="mega-menu-wrap">
                <div class="row">
                    <div class="col m4">
                        <h4 class="row mega-title">Feature</h4>
                        <img class="img-responsive" src="https://3.bp.blogspot.com/-rUk36pd-LbM/VcLb48X4f-I/AAAAAAAAGCI/Y_UxBAgEqwA/s1600/Magento_themes.jpg">
                    </div>
                    <div class="col m2">
                        <h4 class="row mega-title">Standers</h4>
                        <ul class="stander">
                            <li><a href="#">Mobile</a></li>
                            <li><a href="#">Computer</a></li>
                            <li><a href="#">Watch</a></li>
                            <li><a href="#">laptop</a></li>
                            <li><a href="#">Camera</a></li>
                            <li><a href="#">I pad</a></li>
                            <li><a class="view-more btn- btn-sm" href="#">View more</a></li>
                        </ul>
                    </div>
                    <div class="col m3">
                        <h4 class="row mega-title">Description</h4>
                        <ul class="description">
                            <li><a href="#">Women</a>
                                <span>Description of Women</span>
                            </li>
                            <li><a href="#">Men</a>
                                <span>Description of men Cloths</span>
                            </li>
                            <li><a href="#">Kids</a>
                                <span>Description of Kids Cloths</span>
                            </li>
                            <li><a href="#">Others</a>
                                <span>Description of Others Cloths</span>
                            </li>
                            <li>
                                <a class="view-more btn btn-sm " href="#">View more</a>

                            </li>
                        </ul>
                    </div>
                    <div class="col m3">
                        <h4 class="row mega-title">Icon + Description</h4>
                        <ul class="icon-des">
                            <li><a href="#"><i class="fa fa-globe"></i>Web</a></li>
                            <li><a href="#"><i class="fa fa-mobile"></i>Mobile</a></li>
                            <li><a href="#"><i class="fa fa-arrows-h"></i>Responsive</a></li>
                            <li><a href="#"><i class="fa fa-desktop"></i>Desktop</a></li>
                            <li><a href="#"><i class="fa fa-paint-brush"></i>UI/UX</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </li>

</ul> -->


<body class="">
    <nav id="nav" class="white z-depth-0" role="navigation">
        <div class="row">
            <div class="col s12 m3 center">
                <a id="logo-container" class="brand-logo" href="index.php">CLASSY CLOSET</a>
            </div>
            <div class="col s12 m5 offset-m1">
                <ul id="hover" class="hide-on-med-and-down nav-ul">
                    <li><a href="index.php">Home</a> </li>

                    <!-- MEGA MENU -->

                    <!-- <li class="mega-drop-down hide-on-med-and-down">
                        <a>Kid's &nbsp;&nbsp;&nbsp; Women's &nbsp;&nbsp;&nbsp;Men's</a>
                        <div class="animated fadeIn mega-menu">
                            <div class="mega-menu-wrap">
                                <div class="row">
                                    <div class="col m3">
                                        <h4 class="row mega-title">Feature</h4>
                                        <img class="responsive-img" src="media/7.jpg">
                                    </div>
                                    <div class="col m3">
                                        <h4 class="row mega-title"><a href="categories.php?id=3">Kids</a></h4>

                                        <?php
                                        $cat_res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id = '1'");
                                        while ($row = mysqli_fetch_assoc($cat_res)) {

                                        ?>
                                            <ul class="icon-des">
                                                <li><a href="sub_categories.php?id=<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></a></li>
                                            </ul>

                                        <?php } ?>
                                    </div>
                                    <div class="col m3">
                                        <h4 class="row mega-title"><a href="categories.php?id=1">Women's</a></h4>
                                        <?php
                                        $cat_res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id = '3'");
                                        while ($row = mysqli_fetch_assoc($cat_res)) {

                                        ?>
                                            <ul class="icon-des">
                                                <li><a href="sub_categories.php?id=<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></a></li>
                                            </ul>

                                        <?php } ?>
                                    </div>
                                    <div class="col m3">
                                        <h4 class="row mega-title"><a href="categories.php?id=2">Men's</a></h4>
                                        <?php
                                        $cat_res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id = '2'");
                                        while ($row = mysqli_fetch_assoc($cat_res)) {

                                        ?>
                                            <ul class="icon-des">
                                                <li><a href="sub_categories.php?id=<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></a></li>
                                            </ul>

                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li> -->

                    <!-- MEGA MENU - END -->

                    <?php
                    $res = mysqli_query($con, "SELECT * FROM super_category WHERE status=1");
                    while ($row = mysqli_fetch_assoc($res)) {

                    ?>
                        <li><a href="categories.php?id=<?php echo $row['id'] ?>"><?php echo $row['super_category'] ?></a>
                            <ul>
                                <?php
                                $super_id = $row['id'];
                                $res1 = mysqli_query($con, "SELECT * FROM categories WHERE status=1 AND super_categories_id='$super_id'");
                                while ($row1 = mysqli_fetch_assoc($res1)) {
                                ?>
                                    <li><a href="sub_categories.php?id=<?php echo $row1['id'] ?>"><?php echo $row1['categories'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>

            </div>

            <div class="col s12 m3">
                <ul id="hover" class="hide-on-med-and-down nav-ul">
                    <li id="search_icon"><a> <i class="material-icons-outlined">search</i></a> </li>
                    <li id="nav_cart">
                        <div class="htc__shopping__cart">
                            <a class="cart__menu" href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a>
                            <a href="cart.php">
                                <span class="htc__qua"><?php echo $totalProduct ?></span>
                                <!-- <span class="htc__qua1"><?php echo $totalProduct ?></span> -->

                            </a>
                        </div>

                    </li>
                    <li>

                        <?php
                        if (isset($_SESSION['USER_LOGIN'])) {
                            echo
                                '<a> <i class="material-icons-outlined">account_circle</i> &#8964;</a> 
                                    </a>
                                    <ul  class="user">
                                <li><a href="user_profile.php">'
                                    . $_SESSION['USER_NAME'] . '
                                    </a></li>  
                                <li><a href="user_profile.php#my_order">My Orders
                                     </a></li>
                                     <li><a href="user_profile.php#my_wishlist">My Wishlist</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                                     ';
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
                    $super_cat_res = mysqli_query($con, "SELECT * FROM super_category WHERE status=1 ORDER BY super_category ASC");

                    while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
                    ?>
                        <li><a href="categories.php?id=<?php echo $row1['id'] ?>"><?php echo $row1['super_category'] ?></a></li>

                    <?php
                    }
                    ?>
                </ul>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><?php
                    if (isset($_SESSION['USER_LOGIN'])) {
                        echo '<a href="user_profile.php">My Profile</a></li>
                        <li><a href="user_profile.php#my_order">My Orders</a></li>
                        <li><a href="user_profile.php#my_wishlist">My Wishlist</a></li>
                             <li> <a href="logout.php">Logout</a>
                            ';
                    } else {
                        echo '<a href="login.php">Login</a>';
                    }
                    ?>
                </li>
            </ul>
            <a href="#" data-target="nav-mobile" class="left sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right sidenav-trigger hide-on-large-only">
                <li id="search_icon_mobile"><a> <i class="material-icons-outlined">search</i></a> </li>
                <li>
                    <a href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a>
                    <a href="cart.php">
                        <span class="htc__qua"><?php echo $totalProduct ?></span>
                        <!-- <span class="htc__qua1"><?php echo $totalProduct ?></span> -->
                    </a>
                </li>


            </ul>


        </div>
    </nav>
    <div class="divider"></div>




    </div>
    <div id="index_search">

        <form method="POST" action="search.php" id="search_form">
            <div class="row" style="overflow: hidden;">
                <div class="col s2 left">
                    <div id="back_button_mobile" class="hide-on-large-only waves-effect waves-light  btn-flat btn-large">
                        <i class="material-icons-outlined left">keyboard_backspace</i>
                    </div>
                </div>
                <div class="input-field col s8 m12">

                    <input id="search" placeholder="Search for products and more " name="search" type="text" class="validate center">
                    <!-- <label for="search" style="color: #9e9e9e;">Search for products and more </label> -->
                </div>
                <div class="col s2 m2 right">
                    <button type="submit" name="submit" id="search_button_mobile" class="hide-on-large-only waves-effect waves-light btn-large btn-flat">
                        <i class="material-icons-outlined">search</i>
                    </button>


                </div>
            </div>

        </form>
    </div>