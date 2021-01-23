<?php
require('includes/top.inc.php');
isAdmin();

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
                                        <th id="1">Order ID</th>
                                        <th id="2">Order Date</th>
                                        <th id="3">Address</th>
                                        <th id="4">Payment Type</th>
                                        <th id="5">Payment Status</th>
                                        <th id="6">Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $res = mysqli_query($con, "SELECT orders.*,order_status.name as order_status_str FROM orders,order_status WHERE order_status.id = orders.order_status");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><a href="order_master_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.inc.php');
?>