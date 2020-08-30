<?php
require('includes/top.inc.php');
isAdmin();

$categories = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $sql = "SELECT * FROM categories WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
    } else {
        header('location:categories.php');
        die();
    }
}
if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);
    $super_categories_id = get_safe_value($con, $_POST['super_categories_id']);



    $sql = "SELECT * FROM categories WHERE categories = '$categories'";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Category already exists!";
            }
        } else {
            $msg = "Category already exists!";
        }
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = "UPDATE categories SET categories='$categories',super_categories_id='$super_categories_id' WHERE id='$id'";
        } else {
            $sql = "INSERT INTO categories(super_categories_id,categories,status) VALUES ('$super_categories_id','$categories', '1')";
        }
        mysqli_query($con, $sql);
        header('location:categories.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                    <form action="" method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <select name="super_categories_id" class="form-control">
                                    <option>Select Main Category</option>
                                    <?php


                                    $res = mysqli_query($con, "SELECT id,super_category FROM super_category ORDER BY super_category ASC");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($row['id'] == $categories_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['super_category'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['super_category'] . "</option>";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Category</label>
                                <input type="text" name="categories" placeholder="Enter Category name" value="<?php echo $categories ?>" class="form-control" required>
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