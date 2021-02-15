<?php
require('includes/top.inc.php');
isAdmin();

$categories = '';
$msg = '';


if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);



    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "User already exists!";
            }
        } else {
            $msg = "User already exists!";
        }
    }
    if ($msg == '') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin_users(username,password,role,email,mobile,status) VALUES ('$username','$hashed_password', '1','$email','$mobile','1')";
        mysqli_query($con, $sql);
        header('location:vendor_management.php');
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
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <input type="text" name="username" placeholder="Enter Username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="text" name="password" placeholder="Enter Password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input type="text" name="email" placeholder="Enter Email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="form-control-label">Mobile No.</label>
                                <input type="text" name="mobile" placeholder="Enter Mobile" class="form-control" required>
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