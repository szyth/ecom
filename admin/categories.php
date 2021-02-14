<?php
require('includes/top.inc.php');
isAdmin();


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

        $sql_update_status = "UPDATE categories SET status='$status' WHERE id='$id'";
        mysqli_query($con, $sql_update_status);
    }
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $sql_delete_status = "DELETE FROM categories WHERE id='$id'";
        mysqli_query($con, $sql_delete_status);
    }
}


$sql = "SELECT * FROM categories ORDER BY id DESC";
$res = mysqli_query($con, $sql);

$super_cat_res = mysqli_query($con, "SELECT * FROM super_category");
$super_cat_arr = array();
while ($row1 = mysqli_fetch_assoc($super_cat_res)) {
    $super_cat_arr[] = $row1;
}

?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Categories </h4>
                        <h4 class="box-link"><a href="manage_categories.php"><span class='badge badge-danger'>Click to add Category</span></a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial" id="1">#</th>
                                        <th id="2">ID</th>
                                        <th id="3">Main Categories</th>
                                        <th id="4">Sub Categories</th>
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
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo  $super_cat_arr[$row['super_categories_id'] - 1]['super_category'] ?></td>
                                            <td><?php echo $row['categories'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><span class='badge badge-complete'>Active</span></a>&nbsp;";
                                                } else {
                                                    echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><span class='badge badge-pending'>Deactive</span></a>&nbsp;";
                                                }
                                                $msg = "Are you sure you want to delete this Sub-category?";
                                                $editQuery = "manage_categories.php?id=" . $row['id'];
                                                $deleteQuery = "?type=delete&id=" . $row['id'];
                                                ?>
                                                <a href='<?php echo $editQuery ?>'><span class='badge badge-primary'>Edit</span></a>

                                                <!-- COMMENTED OUT DELETE  -->

                                                <!-- <a href='javascript:void(0)' onclick='return getConfirmation("<?php echo $msg ?>", "<?php echo $deleteQuery ?>")'><span class='badge badge-danger'>Delete</span></a> -->
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