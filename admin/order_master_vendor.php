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
                            <table class="table">
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