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

        $sql_update_status = "UPDATE product SET status='$status' $condition1 WHERE id='$id'";
        mysqli_query($con, $sql_update_status);
    }
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $sql_delete_status = "DELETE FROM product WHERE id='$id' $condition1";
        mysqli_query($con, $sql_delete_status);
    }
}



$sql = "SELECT product.*,categories.categories FROM product,categories WHERE product.categories_id=categories.id $condition ORDER BY product.id DESC";
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
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <!-- <td><?php echo $row['id'] ?></td> -->
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['categories'] ?></td>
                                            <td><img src="../media/product/761452992_1 (2).jpg" /></td>
                                            <td>Rs 799</td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><span class='badge badge-complete'>Active</span></a>&nbsp;";
                                                } else {
                                                    echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><span class='badge badge-pending'>Deactive</span></a>&nbsp;";
                                                }
                                                // echo "<a href='manage_product.php?id=" . $row['id'] . "'><span class='badge badge-primary'>Edit</span></a>&nbsp;&nbsp;";

                                                echo "<a href='?type=delete&id=" . $row['id'] . "'><span class='badge badge-danger'>Delete</span></a>";
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