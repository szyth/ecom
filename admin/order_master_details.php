<?php
require('includes/top.inc.php');
$order_id = get_safe_value($con, $_GET['id']);
if (isset($_POST['update_order_status'])) {
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con, "UPDATE orders set order_status = $update_order_status WHERE id = '$order_id'");
}
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Details</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
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
                                    $res = mysqli_query($con, "SELECT DISTINCT(order_detail.id),order_detail.*,product.name as prodname, product.image, orders.name,orders.number,orders.address,orders.city,orders.pincode,orders.order_status from order_detail,product,orders WHERE order_detail.order_id='$order_id' AND orders.user_id='$uid' AND product.id=order_detail.product_id");
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $name = $row['name'];
                                        $number = $row['number'];
                                        $address = $row['address'];
                                        $city = $row['city'];
                                        $pincode = $row['pincode'];
                                        $total_price = $total_price + ($row['qty'] * $row['price']);
                                        $order_status = $row['order_status'];

                                    ?>
                                        <tr>
                                            <td><?php echo $row['prodname'] ?></td>
                                            <td> <img class="responsive-img" style="width: 70px; height:70px;object-fit:cover" src="<?php echo "../media/product/" . $row['image'] ?>" alt="">
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
                            <div class="container">
                                <strong>Address: </strong>
                                <?php echo $name; ?>,
                                <?php echo $number; ?>,
                                <?php echo $address; ?>,
                                <?php echo $city; ?>,
                                <?php echo $pincode; ?>
                                <br>
                                <strong>Order Status: </strong>
                                <?php
                                $res = mysqli_query($con, "SELECT order_status.name FROM order_status, orders WHERE orders.id = $order_id AND orders.order_status = order_status.id");
                                $order_status_arr = mysqli_fetch_assoc($res);
                                echo $order_status_arr['name'];
                                ?>
                                <br>
                                <div>
                                    <form action="" method="post">
                                        <select name="update_order_status" class="form-control">
                                            <option>Select Status</option>
                                            <?php


                                            $res = mysqli_query($con, "SELECT * FROM order_status");
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                if ($row['id'] == $categories_id) {
                                                    echo "<option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                            }

                                            ?>
                                        </select>
                                        <input type="submit" name="" id="" class="form-control" value="Update Status">
                                    </form>

                                </div>
                                <br>
                            </div>
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