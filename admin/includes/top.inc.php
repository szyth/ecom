<?php

require('connection.inc.php');
require('functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
   header('location:login.php');
   die();
}

?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Admin Panel</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
   <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="menu-title">Menu</li>
               <li class="menu-item-has-children dropdown">
                  <a href="product.php"> Product Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <?php
                  if ($_SESSION['ADMIN_ROLE'] == 1) {
                     echo ' <a href="order_master_vendor.php"> Order Master</a>';
                  } else {
                     echo ' <a href="order_master.php"> Order Master</a>';
                  }
                  ?>

               </li>
               <?php
               if ($_SESSION['ADMIN_ROLE'] == 1) {
                  echo '
                <li class="menu-item-has-children dropdown">
                    <a href="vendor_profile.php" >Your Profile</a>
                  </li>';
               }
               ?>
               <?php
               if ($_SESSION['ADMIN_ROLE'] != 1) {
               ?>
                  <li class="menu-item-has-children dropdown">
                     <a href="categories.php"> Categories Master</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="banner.php"> Offer Banner</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                     <a href="users.php"> Customer Management</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="vendor_management.php"> Vendor Management</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="contact_us.php"> Contact Us</a>
                  </li>
               <?php } ?>
            </ul>
         </div>
      </nav>
   </aside>
   <div id="right-panel" class="right-panel">
      <header id="header" class="header">
         <div class="top-left">
            <div class="navbar-header">
               <a class="navbar-brand" style="font-family: 'Oswald', sans-serif;" href="../index.php">
                  <img class="img-responsive" height="40" src="../media/logo/logo-low.png" alt="">

               </a>
               <a class="navbar-brand hidden" href="../index.php">CLASSI CLOSET</a>
               <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
         </div>
         <div class="top-right">
            <div class="header-menu">
               <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $_SESSION['ADMIN_USERNAME'] ?></a>
                  <div class="user-menu dropdown-menu">

                     <?php
                     // prx($_SESSION);
                     if (!$_SESSION['ADMIN_ROLE']) {

                     ?>
                        <a class="nav-link" data-toggle="modal" data-target="#pswdModal" style="cursor:pointer"><i class="fa fa-key"></i>Change Admin Password</a>

                     <?php } ?>
                     <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                  </div>
               </div>
            </div>
         </div>
      </header>

      <!-- PASSWORD CHANGE MODAL  -->
      <div class="modal fade" id="pswdModal" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form>
                     <div class="form-group">
                        <label for="oldpass" class="col-form-label">Current Password:</label>
                        <input type="password" class="form-control" id="oldpass">
                     </div>
                     <div class="form-group">
                        <label for="newpass" class="col-form-label">New Password:</label>
                        <input type="password" class="form-control" id="newpass">
                     </div>
                     <div class="form-group">
                        <label for="cnewpass" class="col-form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="cnewpass">
                     </div>
                     <input id="show" type="checkbox">
                     <label for="show" class="col-form-label">Show Password</label>
                     <p class="helper-text text-danger"></p>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" id="pswd" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>