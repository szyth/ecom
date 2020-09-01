<?php require('includes/header.inc.php');
$order_id = get_safe_value($con, $_GET['id']);
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
    <table class="highlight centered" id="cart">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $uid = $_SESSION['USER_ID'];
            $res = mysqli_query($con, "SELECT DISTINCT(order_detail.id),order_detail.*,product.name, product.image from order_detail,product,orders WHERE order_detail.order_id='$order_id' AND orders.user_id='$uid' AND product.id=order_detail.product_id");
            $total_price = 0;
            while ($row = mysqli_fetch_assoc($res)) {
                $total_price = $total_price + ($row['qty'] * $row['price']);
            ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td> <img class="responsive-img" style="width: 70px; height:70px;object-fit:cover" src="<?php echo "media/product/" . $row['image'] ?>" alt="">
                    </td>
                    <td><?php echo $row['qty'] ?></td>
                    <td>Rs. <?php echo $row['price'] ?></td>
                    <td>Rs. <?php echo $row['qty'] * $row['price'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3"></td>
                <td>Total Price</td>
                <td>Rs.
                    <?php echo $total_price ?>
                </td>
            </tr>
        </tbody>
    </table>

</div>



<section">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
    </section>




    <?php require('includes/footer.inc.php'); ?>