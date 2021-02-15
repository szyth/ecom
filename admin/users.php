<?php
require('includes/top.inc.php');
isAdmin();

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);


    if ($type == "delete") {
        $id = get_safe_value($con, $_GET['id']);
        $sql_delete_status = "DELETE FROM users WHERE id='$id'";
        mysqli_query($con, $sql_delete_status);
    }
}


$sql = "SELECT * FROM users ORDER BY id DESC";
$res = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Users</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial" id="1">#</th>
                                        <th id="2">ID</th>
                                        <th id="3">Name</th>
                                        <th id="4">Encrypted Password</th>
                                        <th id="5">Email</th>
                                        <th id="6">Mobile</th>
                                        <th id="7">Date Format</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['mobile'] ?></td>
                                            <td><?php echo $row['added_on'] ?></td>



                                            <!-- COMMENTED OUT DELETE  -->

                                            <!-- <td>
                                                <?php
                                                $msg = "Are you sure you want delete this User?";
                                                $deleteQuery = "?type=delete&id=" . $row['id'];
                                                ?>
                                                <a href='javascript:void(0)' onclick="return getConfirmation('<?php echo $msg ?>', '<?php echo $deleteQuery ?>')"><span class='badge badge-danger'>Delete</span></a>
                                            </td> -->
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