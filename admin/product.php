<?php
require('includes/top.inc.php');


$condition = '';
$condition1 = '';
if ($_SESSION['ADMIN_ROLE'] == 1) {
    $condition = " AND product_new.added_by = '" . $_SESSION['ADMIN_ID'] . "'";
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
        $getproduct = get_product($con, '', '', $id);
        $getImageSuperId = $getproduct[0]['image_super_id'];
        mysqli_query($con, "DELETE FROM product_new WHERE id=$id $condition1");
        $res = mysqli_query($con, "SELECT * FROM product_images WHERE super_id=$getImageSuperId");
        while ($row = mysqli_fetch_assoc($res)) {
            $filePath =  "../media/product/" . $row['name'];
            unlink($filePath);
        }
        mysqli_query($con, "DELETE FROM product_images WHERE  super_id=$getImageSuperId");
    }
}

// if (isset($_GET['order'])) {
//     $order = $_GET['order'];
// } else {
//     $order = 'product_new.id';
// }
// if (isset($_GET['sort'])) {
//     $sort = $_GET['sort'];
// } else {
//     $sort = 'ASC';
// }


$sql = "SELECT product_new.*,categories.categories FROM product_new,categories WHERE product_new.subcat_id=categories.id $condition ORDER BY product_new.id DESC";
// $sql = "SELECT product_new.*,categories.categories FROM product_new,categories WHERE product_new.subcat_id=categories.id $condition ORDER BY $order $sort";
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
                        <div class="table-stats order-table ov-h table-responsive-md">
                            <table class="table table-hover" id="mytable">
                                <thead>
                                    <tr>
                                        <th class="serial" id="1">#</th>
                                        <!-- <th>ID</th> -->
                                        <th style="width: 150px !important;" id="2">Name</th>
                                        <th id="3">Categories</th>
                                        <th>Image</th>
                                        <th id="4">MRP</th>
                                        <th id="5">Discount</th>
                                        <th id="6">SP</th>
                                        <th id="7">QTY</th>
                                        <th id="8">Added By</th>
                                        <th>Actions</th>
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
                                            <td style="cursor: pointer;" data-toggle="tooltip" title="<?php echo "Description: " . $row['description']; ?>
                                            <?php
                                            $res_added_by = mysqli_query($con, "SELECT username FROM admin_users WHERE id=" . $row['added_by'] . "");
                                            $row_added_by  = mysqli_fetch_assoc($res_added_by);
                                            $addedBy = $row_added_by['username'] == null ? "NA" : $row_added_by['username'];
                                            // echo "\nAdded By: " . $row_added_by['username'];
                                            ?>"><?php echo $row['name'] ?></td>
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
                                            <td><?php echo $addedBy; ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><i style='color:#5AA57D' class='fa fa-toggle-on fa-2x' aria-hidden='true'></i></a>&nbsp;";
                                                } else {
                                                    echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><i style='color:black' class='fa fa-toggle-off fa-2x' aria-hidden='true'></i></a>&nbsp;";
                                                }
                                                // echo "<a href='manage_product.php?id=" . $row['id'] . "'><span class='badge badge-primary'>Edit</span></a>&nbsp;&nbsp;";
                                                $msg = "Are you sure you want to delete this product?";
                                                $deleteString = "?type=delete&id=" . $row['id'];
                                                $editString = "manage_products.php?action=edit&p_id=" . $row['id'];
                                                ?>
                                                <a title='Edit Product' href='<?php echo $editString ?>'><i style='color:#00587a' class='fa fa-edit fa-2x' aria-hidden='true'></i></a>


                                                <!-- COMMENTED OUT DELETE  -->

                                                <!-- <a title='Delete Product' href='javascript:void(0)' onClick="return getConfirmation('<?php echo $msg ?>', '<?php echo $deleteString ?>')"><i style='color:#ec4633' class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a> -->
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