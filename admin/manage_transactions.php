<?php
require('includes/top.inc.php');
isAdmin();

$msg = '';
$vendor_id = get_safe_value($con, $_GET['id']);

if (isset($_POST['submit'])) {
    date_default_timezone_set(
        'Asia/Kolkata'
    );
    $date = date('Y-m-d h:i:s');
    $amount = get_safe_value($con, $_POST['amount']);
    $pending = get_safe_value($con, $_POST['pending']);
    $notes = get_safe_value($con, $_POST['notes']);



    if ($msg == '') {
        $sql = "INSERT INTO transaction(vendor_id,date,amount,pending,notes) VALUES ('$vendor_id', '$date','$amount','$pending','$notes')";
        mysqli_query($con, $sql);
?>
        <script>
            window.location.href = 'vendor_details.php?id=<?php echo $vendor_id ?>';
        </script>
<?php
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Vendor</strong><small> Form</small></div>
                    <form action="" method="post">
                        <div class="card-body card-block">
                            <h4 style="color: #ff1111;">Transaction Date will be updated automatically!</h4>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="amount" class="form-control-label">Transaction Amount</label>
                                <input type="number" name="amount" placeholder="Enter amount paid to the vendor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pending" class="form-control-label">Pending Amount</label>
                                <input type="number" name="pending" placeholder="Enter pending amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="form-control-label">Notes</label>
                                <input type="text" name="notes" placeholder="add transaction notes" class="form-control">
                            </div>
                            <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error">
                                <?php echo $msg ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/footer.inc.php');
?>