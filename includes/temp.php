    <div class="">
        <nav id="nav" class="white z-depth-0" role="navigation">
            <div class="row">
                <div class="col s12 m3 center">
                    <a id="logo-container" class="brand-logo" href="index.php">CLASSY CLOSET</a>
                </div>
                <div class="col s12 m6 push-custom">
                    <div class="menu-container">
                        <div class="menu">
                            <ul id="hover" class="hide-on-med-and-down nav-ul">
                                <li><a href="index.php">Home</a> </li>
                                <li><a href="index.php">Categories</a>
                                    <ul>


                                        <?php

                                        $super_cat_res = mysqli_query($con, "SELECT * FROM super_category WHERE status=1 ORDER BY super_category ASC");

                                        while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
                                            $super_cat_arr[] = $row1;
                                        ?>
                                            <li class="cat"><a href="categories.php?id=<?php echo $row1['id'] ?>"><?php echo $row1['super_category'] ?> </a>
                                                <ul class="cat">
                                                    <?php
                                                    $x = $row1['id'];
                                                    $cat_res = mysqli_query($con, "SELECT * FROM categories WHERE super_categories_id = $x");
                                                    while ($row = mysqli_fetch_assoc($cat_res)) {
                                                    ?>
                                                        <li>
                                                            <a id="cat_button" href="sub_categories.php?id=<?php echo $row['id'] ?>" class="black-text">
                                                                <?php echo $row['categories'] ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>

                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col s12 m3">
                    <div class="menu-container">
                        <div class="menu">
                            <ul id="hover" class="hide-on-med-and-down nav-ul">
                                <li id="search_icon"><a> <i class="material-icons-outlined">search</i></a> </li>
                                <li id="nav_cart">
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                                    </div>

                                </li>
                                <li>

                                    <?php
                                    if (isset($_SESSION['USER_LOGIN'])) {
                                        echo
                                            '<a> <i class="material-icons-outlined">account_circle</i> &#8964;</a> 
                                    </a>
                                    <ul  class="user">
                                <li><a>'
                                                . $_SESSION['USER_NAME'] . '
                                    </a></li>  
                                <li><a href="my_order.php">My Orders
                                     </a></li>
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
                    </div>
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
                    <li><a href="cart.php">Cart</a></li>
                    <li><?php
                        if (isset($_SESSION['USER_LOGIN'])) {
                            echo '<a href="my_order.php">My Orders</a></li>
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
                    <li>
                        <a href="cart.php"><i class="material-icons-outlined">shopping_cart</i></a>
                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                    </li>
                    <li id="search_icon_mobile"><a> <i class="material-icons-outlined">search</i></a> </li>

                </ul>


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
                <div class="row" style="overflow: hidden;">
                    <div class="col s2 left">
                        <div id="back_button_mobile" class="hide-on-large-only waves-effect waves-light  btn-flat btn-large">
                            <i class="material-icons-outlined left">keyboard_backspace</i>
                        </div>
                    </div>
                    <div class="input-field col s8 m7">

                        <input id="search" placeholder="Search for products and more " name="search" type="text" class="validate">
                        <!-- <label for="search" style="color: #9e9e9e;">Search for products and more </label> -->
                    </div>
                    <div class="col s2 m2 right">
                        <button type="submit" name="submit" id="search_button" class="hide-on-med-and-down waves-effect waves-light btn-large btn-flat ">
                            <i class="material-icons-outlined">search</i>Search
                        </button>
                        <button type="submit" name="submit" id="search_button_mobile" class="hide-on-large-only waves-effect waves-light btn-large btn-flat">
                            <i class="material-icons-outlined">search</i>
                        </button>


                    </div>
                </div>

            </form>
        </div>
    </div>
    nav {
    height: 15vh !important;
    position: relative;
    z-index: 999;
    line-height: 15vh;
    /* overflow: hidden; */
    text-transform: uppercase;
    }

    @media screen and (max-width: 992px) {
    nav {
    overflow: hidden;
    }

    nav ul a {
    padding-right: 2%;
    }
    }

    .nav-ul {
    font-weight: 600;
    }

    .brand-logo {
    font-size: 2.1rem !important;
    font-family: "Oswald", sans-serif;
    }

    nav ul a:hover {
    background-color: rgba(255, 0, 0, 0.1);
    }

    .row .col.push-custom {
    left: 10% !important;
    }


    #index_search {
    display: none;
    }

    /*
    nav ul li {
    position: relative;
    } */

    /*

    nav ul li ul {
    position: initial;
    width: 800px !important;
    padding: 0 !important;
    margin: 0 !important;
    }

    nav ul li ul li {
    position: initial;
    padding: 0 !important;
    margin: 0 !important;
    }

    nav ul li ul li a {
    padding: 0 !important;
    height: 50px;
    line-height: 50px;
    margin: 0 !important;
    font-size: 1em;
    }

    nav ul li ul li ul li {
    padding: 0 !important;
    height: 50px !important;
    line-height: 50px !important;
    margin: 0 !important;
    }

    nav ul li ul li ul li a {
    padding: 0 !important;
    margin: 0 !important;
    }
    */

    /* DROPDOWN */
    /* .cat {
    min-width: 16% !important;
    text-align: center;

    }

    .user {
    min-width: 150px !important;

    }

    #hover li ul li {
    height: 6vw;
    }

    #hover li ul {
    position: absolute;
    visibility: hidden;
    }

    #hover li ul li {
    float: none;
    }

    #hover li ul li a {
    width: auto;
    background: #ffffff
    }

    #hover li ul li a:hover {
    background: #e9e9e9
    }
    */

    /* DROPDOWN - END */


    nav i,
    nav [class^="mdi-"],
    nav [class*="mdi-"],
    nav i.material-icons {
    display: unset;
    }

    .material-icons-outlined {
    font-weight: 300;
    color: #442644c5;
    vertical-align: middle;
    display: inline;
    }

    @media screen and (max-width: 992px) {
    .brand-logo {
    font-size: 1.5rem !important;
    }

    #nav .material-icons-outlined {
    color: rgb(156, 0, 86);
    vertical-align: unset;
    }
    }