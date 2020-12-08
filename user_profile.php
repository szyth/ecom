<?php require('includes/header.inc.php'); ?>

<section id="profile">
    <div class="row">
        <div class="col s12 m3 user_nav hide-on-med-and-down">
            <ul class="center">
                <img class="pfp" src="media/user/profile-image-placeholder.png" alt="">
                <li><a href="user_profile.php#user_profile">My Profile</a></li>
                <li><a href="user_profile.php#my_wishlist">My Wishlist</a></li>
                <li><a href="user_profile.php#my_order">My Orders</a></li>
            </ul>
        </div>
        <div id="user_profile" class="col s12 l9" style="margin-top:10px ;">
            <div class="card">
                <div class="row">
                    <div class="col s10 offset-s1 m5 offset-m1">
                        <h3 class="title">My Profile</h3>
                        <?php
                        $user_id = $_SESSION['USER_ID'];
                        $row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'"));

                        ?>

                        <h5><i class="fa fa-user-o" aria-hidden="true"></i><?php echo $row['name'] ?></h5>
                        <h5><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo $row['email'] ?></h5>
                        <h5><i class="fa fa-phone" aria-hidden="true"></i><?php echo $row['mobile'] ?></h5>
                        <h5><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $row['added_on'] ?></h5>
                    </div>
                    <div class="col s10 offset-s1 m5">
                        <form id="address_form" method="POST">
                            <div class="row">
                                <div id="address_details" class="title center">
                                    <h1 style="margin-top: 1.8rem !important;">My Saved Address</h1>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;Full Name" id="name" name="name" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;Mobile No." id="number" name="number" type="tel" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="&nbsp;Address" id="address" name="address" type="text" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;City" id="city" name="city" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;Pincode" id="pincode" name="pincode" type="text" class="validate">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="my_wishlist" class="card">


                <div class="row" style="padding: 10px;">
                    <h3 class="title center">Wishlist</h3>
                    <?php
                    $uid = $_SESSION['USER_ID'];
                    $res = mysqli_query($con, "SELECT product.* FROM product,wishlist WHERE wishlist.user_id='$uid' AND wishlist.product_id=product.id");
                    while ($list = mysqli_fetch_assoc($res)) {

                    ?>
                        <div class="col s6 m4 l3 product_container_inner">
                            <div class="dress-card box_shadow center">
                                <a href="product.php?id=<?php echo $list['id'] ?>" class="black-text">
                                    <div class="dress-card-head">
                                        <img class="dress-card-img-top" src="<?php echo "media/product/" . $list['image'] ?>" alt="">
                                    </div>
                                    <div class="dress-card-body">
                                        <h4 class="dress-card-title"> <?php echo $list['name'] ?></h4>
                                        <p class="dress-card-para">
                                            <span class="dress-card-price ">Rs.<?php echo $list['price'] ?> &ensp;</span>
                                            <span class="dress-card-crossed ">Rs.<?php echo $list['mrp'] ?></span>
                                            <!-- <span class="dress-card-off">&ensp;(60% OFF)</span> -->
                                        </p>
                                    </div>
                                </a>

                            </div>
                        </div>
                    <?php
                    } ?>

                </div>
            </div>
            <div id="my_order" class="card">
                <div class="row" style="padding: 10px;">
                    <h3 class="title center">Orders</h3>
                    <table class="highlight centered responsive-table" id="cart">

                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Address</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uid = $_SESSION['USER_ID'];

                            $res = mysqli_query($con, "SELECT orders.*,order_status.name as order_status_str FROM orders,order_status WHERE orders.user_id = '$uid' AND order_status.id = orders.order_status");
                            while ($row = mysqli_fetch_assoc($res)) {

                            ?>
                                <tr>
                                    <td>
                                        <a href="my_order_details.php?id=<?php echo $row['id'] ?>">
                                            <!-- <?php echo $row['id'] ?> -->
                                            Click to know more
                                        </a>
                                    </td>
                                    <td><?php echo $row['added_on'] ?></td>
                                    <td>
                                        <?php echo $row['address'] ?>
                                        <?php echo $row['city'] ?>
                                        <?php echo $row['pincode'] ?>
                                    </td>
                                    <td><?php echo $row['payment_type'] ?></td>
                                    <td><?php echo $row['payment_status'] ?></td>
                                    <td><?php echo $row['order_status_str'] ?></td>

                                </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</section>



<section style="background-color: rgb(255, 255, 255);">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>


<?php require('includes/footer.inc.php'); ?>