<?php
require('includes/top.inc.php');

$msg = '';
$vendor_id = $_SESSION['ADMIN_ID'];
$aadhar_card = '';
$pan_card = '';
$aadhar_required = '';
$pan_required = '';


if (isset($_POST['submit'])) {
    $added_on = date('Y-m-d h:i:s');


    if ($_FILES['aadhar_card']['type'] != $aadhar_card && $_FILES['aadhar_card']['type'] != 'image/png' && $_FILES['aadhar_card']['type'] != 'image/jpg' && $_FILES['aadhar_card']['type'] != 'image/jpeg') {
        $msg = "Please select only PNG,JPG or JPEG image format";
    }
    if ($_FILES['pan_card']['type'] != $pan_card && $_FILES['pan_card']['type'] != 'image/png' && $_FILES['pan_card']['type'] != 'image/jpg' && $_FILES['pan_card']['type'] != 'image/jpeg') {
        $msg = "Please select only PNG,JPG or JPEG image format";
    }

    if ($msg == '') {

        $res = mysqli_query($con, "SELECT * FROM vendor_docs WHERE vendor_id='$vendor_id'");
        $row = mysqli_fetch_assoc($res);

        if (isset($row['id']) && $row['id'] != '') {
            if ($_FILES['aadhar_card']['name'] != '') {
                $aadhar_card = rand(111111111, 999999999) . '_' . $_FILES['aadhar_card']['name'];
                move_uploaded_file($_FILES['aadhar_card']['tmp_name'], "../media/docs/" . $aadhar_card);
                chmod("../media/docs/" . $aadhar_card, 0777);

                $sql = "UPDATE vendor_docs SET aadhar_card='$aadhar_card',added_on='$added_on' WHERE vendor_id='$vendor_id'";
            } elseif ($_FILES['pan_card']['name'] != '') {
                $pan_card = rand(111111111, 999999999) . '_' . $_FILES['pan_card']['name'];
                move_uploaded_file($_FILES['pan_card']['tmp_name'], "../media/docs/" . $pan_card);
                chmod("../media/docs/" . $pan_card, 0777);
                $sql = "UPDATE vendor_docs SET pan_card='$pan_card',added_on='$added_on' WHERE vendor_id='$vendor_id'";
            } else {


                $sql = "UPDATE vendor_docs SET added_on='$added_on' WHERE vendor_id='$vendor_id'";
            }
        } else {
            $aadhar_card = rand(111111111, 999999999) . '_' . $_FILES['aadhar_card']['name'];
            move_uploaded_file($_FILES['aadhar_card']['tmp_name'], "../media/docs/" . $aadhar_card);
            chmod("../media/docs/" . $aadhar_card, 0777);


            $pan_card = rand(111111111, 999999999) . '_' . $_FILES['pan_card']['name'];
            move_uploaded_file($_FILES['pan_card']['tmp_name'], "../media/docs/" . $pan_card);
            chmod("../media/docs/" . $pan_card, 0777);


            $sql = "INSERT INTO vendor_docs(vendor_id,aadhar_card,pan_card,added_on) VALUES ('$vendor_id', '$aadhar_card','$pan_card','$added_on')";
        }
        mysqli_query($con, $sql);
?>
        <script>
            window.location.href = 'vendor_profile.php?id=<?php echo $vendor_id ?>';
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
                    <div class="card-header"><strong>Vendor Government IDs</strong><small> Form</small></div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="aadhar_card" class="form-control-label">Upload Aadhar Card</label>
                                <input type="file" name="aadhar_card" class="form-control" <?php echo $aadhar_required ?>>
                            </div>
                            <div class="form-group">
                                <label for="pan_card" class="form-control-label">Upload Pan Card</label>
                                <input type="file" name="pan_card" class="form-control" <?php echo $pan_required ?>>
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