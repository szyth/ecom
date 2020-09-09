<?php
require('includes/top.inc.php');
isAdmin();

$vendor_id = get_safe_value($con, $_GET['id']);

$res = mysqli_query($con, "SELECT * FROM admin_users WHERE id='$vendor_id'");
$row = mysqli_fetch_assoc($res);

?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"><small>Transaction details for : </small><?php echo $row['username'] ?></h4>
                        <h4 class="box-link"><a href="manage_transactions.php?id=<?php echo $vendor_id ?>"><span class='badge badge-danger'>Click to add a Transaction</span></a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th> ID</th>
                                        <th>Transaction Date</th>
                                        <th>Transaction Amount</th>
                                        <th>Pending Amount</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $res = mysqli_query($con, "SELECT * FROM transaction WHERE vendor_id = '$vendor_id'");
                                    while ($list = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <td><?php echo $list['id'] ?></td>
                                            <td><?php echo $list['date'] ?></td>
                                            <td><?php echo $list['amount'] ?></td>
                                            <td><?php echo $list['pending'] ?></td>
                                            <td><?php echo $list['notes'] ?></td>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Government IDs</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Aadhar Card</th>
                                        <th>Pan Card</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $res = mysqli_query($con, "SELECT * FROM vendor_docs WHERE vendor_id = '$vendor_id'");
                                    while ($list = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><img style="max-width: 300px !important;" src="<?php echo "../media/docs/" . $list['aadhar_card'] ?>" /></td>
                                            <td><img style="max-width: 300px !important;" src="<?php echo "../media/docs/" . $list['pan_card'] ?>" /></td>
                                            <td><?php echo $list['added_on'] ?></td>
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