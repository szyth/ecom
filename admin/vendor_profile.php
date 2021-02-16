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
                        <h4 class="box-link"><a href="" data-toggle="modal" data-target="#pswdModal"><span class='badge badge-primary'>Change Password</span></a></h4>
                        <p style="  color: #ff1b4c;font-size:13px;margin:16px 0">Tip: Change Password on First Login</p>
                        <!-- PASSWORD CHANGE MODAL  -->
                        <div class="modal fade" id="pswdModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="oldpass" class="col-form-label">Current Password:</label>
                                                <input type="password" class="form-control" id="oldpass">
                                            </div>
                                            <div class="form-group">
                                                <label for="newpass" class="col-form-label">New Password:</label>
                                                <input type="password" class="form-control" id="newpass">
                                            </div>
                                            <div class="form-group">
                                                <label for="cnewpass" class="col-form-label">Confirm Password:</label>
                                                <input type="password" class="form-control" id="cnewpass">
                                            </div>
                                            <input id="show" type="checkbox">
                                            <label for="show" class="col-form-label">Show Password</label>
                                            <p class="helper-text text-danger"></p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="pswd" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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