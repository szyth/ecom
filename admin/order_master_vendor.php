<?php
require('includes/top.inc.php');

$sql = "SELECT * FROM users ORDER BY id DESC";
$res = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <!-- <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product/Quantity</th>
                                        <th>Address</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $res = mysqli_query($con, "SELECT order_detail.qty, product.name as prodname , orders.*,order_status.name as order_status_str FROM order_detail,product,orders,order_status WHERE order_status.id = orders.order_status AND product.id=order_detail.product_id AND orders.id=order_detail.order_id AND product.added_by='" . $_SESSION['ADMIN_ID'] . "' ORDER BY orders.id DESC");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></a></td>
                                            <td>
                                                <?php echo $row['prodname'] ?>
                                                <?php echo $row['qty'] ?>
                                            </td>
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
                            </table> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // $sql = "SELECT DISTINCT(order_detail.id),order_detail.*,product.name as prodname, product.image, orders.name,orders.number,orders.address,orders.city,orders.pincode,orders.order_status from order_detail,product,orders WHERE order_detail.order_id='$order_id' AND orders.user_id='$uid' AND product.id=order_detail.product_id";
                                    $sql = "SELECT order_detail.* FROM order_detail inner join product_new on product_new.id=order_detail.product_id AND product_new.added_by ='" . $_SESSION['ADMIN_ID'] . "'  ";
                                    $res = mysqli_query($con, $sql);
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $productId = $row['product_id'];
                                        $qty = $row['qty'];
                                        $price = $row['price'];
                                        // $uid = $row['user_id'];

                                        $productArr = get_product($con, '', '', $productId);
                                        $total_price = $total_price + ($qty * $price);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['order_id'] ?>
                                            </td>
                                            <td>
                                                <a style="color: black;" href="../product.php?id=<?php echo $productArr[0]['id'] ?>">
                                                    <?php echo $productArr[0]['name'] ?>
                                                </a>
                                            </td>
                                            <td> <img class="responsive-img" style="width: 70px; height:70px;object-fit:cover" src="<?php echo "../media/product/" . $productArr[0]['image'][0] ?>" alt="">
                                            </td>
                                            <td><?php
                                                $sizeId = $productArr[0]['size'];
                                                $size = mysqli_fetch_assoc(mysqli_query($con, "SELECT name as size FROM product_size WHERE id=$sizeId"));
                                                echo $size['size'];
                                                ?></td>
                                            <td><?php
                                                $colorId = $productArr[0]['color'];
                                                $color = mysqli_fetch_assoc(mysqli_query($con, "SELECT name as color FROM product_color WHERE id=$colorId"));
                                                echo $color['color'];
                                                ?></td>
                                            <td><?php echo $qty ?></td>
                                            <td>Rs. <?php echo $price ?></td>
                                            <td>Rs. <?php echo $qty * $price ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>Total Price</td>
                                        <td>Rs.
                                            <?php echo $total_price ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.inc.php');
?>