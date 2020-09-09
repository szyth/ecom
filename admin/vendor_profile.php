<?php
require('includes/top.inc.php');

$vendor_id = $_SESSION['ADMIN_ID'];

?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Profile </h4>
                        <h4 class="box-link"><a href="manage_vendor_profile.php"><span class='badge badge-danger'>Click to add/update your Government IDs</span></a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th> ID</th>
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
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <td><?php echo $list['id'] ?></td>
                                            <td><?php echo $list['aadhar_card'] ?></td>
                                            <td><?php echo $list['pan_card'] ?></td>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Transaction record </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th> ID</th>
                                        <th>Transaction Date</th>
                                        <th>Transaction Amount from admin</th>
                                        <th>Pending Amount of admin</th>
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
    </div>
</div>

<?php
require('includes/footer.inc.php');
?>