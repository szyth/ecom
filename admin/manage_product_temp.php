<?php
require('includes/top.inc.php');

$condition = '';
$condition1 = '';
if ($_SESSION['ADMIN_ROLE'] == 1) {
    $condition = " AND product.added_by = '" . $_SESSION['ADMIN_ID'] . "'";
    $condition1 = " AND added_by = '" . $_SESSION['ADMIN_ID'] . "'";
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <select id="sid" class="form-control">
                                    <option>Select Category</option>
                                    <?php
                                    $res = mysqli_query($con, "SELECT * FROM super_category ORDER BY super_category ASC");
                                    while ($row = mysqli_fetch_assoc($res)) {

                                        echo "<option value=" . $row['id'] . ">" . $row['super_category'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="categories_id" class="form-control" id="sub_cat">
                                    <option>Select Sub Category</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="categories" class="form-control-label">Product Name</label>
                                <input type="text" name="name" placeholder="Enter Product name" value="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea name="description" placeholder="Please enter Product Description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <select name="color" class="form-control">
                                    <option selected disabled>Select Color</option>
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="size" class="form-control">
                                    <option selected disabled>Select Size</option>
                                    <option value="s">Small</option>
                                    <option value="m">Medium</option>
                                    <option value="l">Large</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="fabric" class="form-control">
                                    <option selected disabled>Select Fabric</option>
                                    <option value="cotton">Cotton</option>
                                    <option value="linen">Linen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-control-label">Price</label>
                                <input type="text" name="price" placeholder="Enter Price" value="" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
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