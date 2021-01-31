<?php
require('includes/top.inc.php');
isAdmin();
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
                                    $sql = "SELECT DISTINCT(order_detail.id),order_detail.*,orders.user_id FROM order_detail,orders WHERE order_detail.order_id=$order_id ";
                                    $res = mysqli_query($con, $sql);
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $productId = $row['product_id'];
                                        $qty = $row['qty'];
                                        $price = $row['price'];
                                        $uid = $row['user_id'];

                                        $productArr = get_product($con, '', '', $productId);
                                        $total_price = $total_price + ($qty * $price);
                                    ?>
                                        <tr>
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
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Order Status: </strong>
                                        <?php
                                        $res = mysqli_query($con, "SELECT order_status.name FROM order_status, orders WHERE orders.id = $order_id AND orders.order_status = order_status.id");
                                        $order_status_arr = mysqli_fetch_assoc($res);
                                        echo $order_status_arr['name'];
                                        ?>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
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
                                </div>


                                <br>

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