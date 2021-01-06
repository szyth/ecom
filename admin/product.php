<?php
require('includes/top.inc.php');


$condition = '';
$condition1 = '';
if ($_SESSION['ADMIN_ROLE'] == 1) {
    $condition = " AND product.added_by = '" . $_SESSION['ADMIN_ID'] . "'";
    $condition1 = " AND added_by = '" . $_SESSION['ADMIN_ID'] . "'";
}


if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'status') {

        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = '1';
        } else if ($operation == 'deactive') {
            $status = '0';
        } else {
            echo "Wrong Input";
        }

        $sql_update_status = "UPDATE product_new SET status='$status' $condition1 WHERE id='$id'";
        mysqli_query($con, $sql_update_status);
    }
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $sql_delete_status = "DELETE FROM product_new WHERE id='$id' $condition1";
        mysqli_query($con, $sql_delete_status);
    }
}



$sql = "SELECT product_new.*,categories.categories FROM product_new,categories WHERE product_new.subcat_id=categories.id $condition ORDER BY product_new.id DESC";
$res = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Products </h4>
                        <h4 class="box-link"><a href="manage_products.php"><span class='badge badge-danger'>Click to add Product</span></a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <!-- <th>ID</th> -->
                                        <th style="width: 200px !important;">Name</th>
                                        <th>Categories</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Discount</th>
                                        <th>SP</th>
                                        <th>QTY</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $image_super_id = $row['image_super_id'];
                                        $image = "SELECT `name` AS `image` FROM product_images WHERE product_images.super_id=$image_super_id";
                                        $res_image = mysqli_query($con, $image);
                                        $row_image = mysqli_fetch_assoc($res_image);
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <!-- <td><?php echo $row['id'] ?></td> -->
                                            <td style="cursor: pointer;" data-toggle="tooltip" title="<?php echo $row['description'] ?>"><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['categories'] ?></td>
                                            <td><img src="../media/product/<?php echo $row_image['image'] ?>" /></td>
                                            <td><?php echo $row['mrp'] ?></td>
                                            <td><?php
                                                if ($row['discount_type'] == "rate") {
                                                    echo "Rs. " . $row['discount'] . "</td><td>Rs. " . ($row["mrp"] - $row["discount"]) . "</td>";
                                                } elseif ($row['discount_type'] == "percent") {
                                                    echo  $row['discount'] .   "%</td><td>Rs. " . ($row["mrp"] - (($row["discount"] * $row["mrp"]) / 100)) . "</td>";
                                                } else {
                                                    echo "0</td><td>Rs. " . $row["mrp"] . "</td>";
                                                }

                                                ?></td>

                                            <td><?php echo $row['quantity'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><i style='color:#5AA57D' class='fa fa-toggle-on fa-2x' aria-hidden='true'></i></a>&nbsp;";
                                                } else {
                                                    echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><i style='color:black' class='fa fa-toggle-off fa-2x' aria-hidden='true'></i></a>&nbsp;";
                                                }
                                                // echo "<a href='manage_product.php?id=" . $row['id'] . "'><span class='badge badge-primary'>Edit</span></a>&nbsp;&nbsp;";

                                                echo "&nbsp;&nbsp;<a href='?type=delete&id=" . $row['id'] . "'><i style='color:#ec4633' class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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