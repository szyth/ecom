<?php require('includes/header.inc.php');

?>


<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.php" class="breadcrumb">Home</a>
                            <a class="breadcrumb">My Orders</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
    </div>




</section>

<div class="container">
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
                    <td><a href="my_order_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
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
            <?php } ?>
        </tbody>
    </table>

</div>



<section">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
    </section>




    <?php require('includes/footer.inc.php'); ?>