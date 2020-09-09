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

        $sql_update_status = "UPDATE admin_users SET status='$status' WHERE id='$id'";
        mysqli_query($con, $sql_update_status);
    }
    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $sql_delete_status = "DELETE FROM admin_users WHERE id='$id'";
        mysqli_query($con, $sql_delete_status);
    }
}


$sql = "SELECT * FROM admin_users WHERE role=1 ORDER BY id DESC";
$res = mysqli_query($con, $sql);

?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Vendor Management </h4>
                        <h4 class="box-link"><a href="manage_vendor.php"><span class='badge badge-danger'>Click to add Vendors</span></a></h4>

                        <br>
                        <br>
                        <h6 style="color: #ff1111;">Click on USERNAME to See their IDs and Add Transaction</h6>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
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
                                            <td><a href="vendor_details.php?id=<?php echo $row['id'] ?>"> <?php echo $row['username'] ?></a></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['mobile'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><span class='badge badge-complete'>Active</span></a>&nbsp;";
                                                } else {
                                                    echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><span class='badge badge-pending'>Deactive</span></a>&nbsp;";
                                                }
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