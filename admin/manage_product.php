<?php
require('includes/top.inc.php');

$condition = '';
$condition1 = '';
if ($_SESSION['ADMIN_ROLE'] == 1) {
    $condition = " AND product.added_by = '" . $_SESSION['ADMIN_ID'] . "'";
    $condition1 = " AND added_by = '" . $_SESSION['ADMIN_ID'] . "'";
}

$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$brand = '';
$color = '';
$size = '';
$fabric = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';




$msg = '';
$image_required = 'required';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $sql = "SELECT * FROM product WHERE id = '$id' $condition1";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);
    if ($check > 0) {

        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $brand = $row['brand'];
        $color = $row['color'];
        $size = $row['size'];
        $fabric = $row['fabric'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
    } else {
        //header('location:product.php'); 
?>
        <script>
            location.replace("product.php");
        </script>
<?php
        die();
    }
}
if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $brand = get_safe_value($con, $_POST['brand']);
    $color = get_safe_value($con, $_POST['color']);
    $size = get_safe_value($con, $_POST['size']);
    $fabric = get_safe_value($con, $_POST['fabric']);
    $qty = get_safe_value($con, $_POST['qty']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

    $sql = "SELECT * FROM product WHERE name = '$name' $condition1";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Product already exists!";
            }
        } else {
            $msg = "Product already exists!";
        }
    }
    if ($_FILES['image']['type'] != $image && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
        $msg = "Please select only PNG,JPG or JPEG image format";
    }
    if ($msg == '' && $categories_id != '0') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            if ($_FILES['image']['name'] != '') {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                $destFile = "../media/product/" . $image;
                move_uploaded_file($_FILES['image']['tmp_name'], $destFile);
                chmod($destFile, 0755);



                $sql = "UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',brand='$brand',color='$color',size='$size',fabric='$fabric',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' WHERE id='$id'";
            } else {
                $sql = "UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',brand='$brand',color='$color',size='$size',fabric='$fabric',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE id='$id'";
            }
        } else {
            $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
            $destFile = "../media/product/" . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $destFile);
            chmod($destFile, 0755);


            $sql = "INSERT INTO product(categories_id,name,mrp,price,brand,color,size,fabric,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,added_by) VALUES ('$categories_id','$name','$mrp','$price','$brand','$color','$size','$fabric','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1','$image','" . $_SESSION['ADMIN_ID'] . "')";
        }
        mysqli_query($con, $sql);
        header('location:product.php');
        die();
    }
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
                                <input type="text" name="name" placeholder="Enter Product name" value="<?php echo $name ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">MRP</label>
                                <input type="text" name="mrp" placeholder="Enter Product MRP" value="<?php echo $mrp ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Price</label>
                                <input type="text" name="price" placeholder="Enter Product Price" value="<?php echo $price ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Brand</label>
                                <input type="text" name="brand" placeholder="Enter Brand Name" value="<?php echo $brand ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Color</label>
                                <input type="text" name="color" placeholder="Enter Color" value="<?php echo $color ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Size</label>
                                <input type="text" name="size" placeholder="Enter Product Size" value="<?php echo $size ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Fabric</label>
                                <input type="text" name="fabric" placeholder="Enter Cloth Fabric" value="<?php echo $fabric ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Quantity</label>
                                <input type="text" name="qty" placeholder="Qty" value="<?php echo $qty ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Short Description</label>
                                <textarea name="short_desc" placeholder="Please enter short Product Description" class="form-control" required><?php echo $short_desc ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Description</label>
                                <textarea name="description" placeholder="Please enter Product Description" class="form-control" required><?php echo $description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Meta Title</label>
                                <textarea name="meta_title" placeholder="Please enter Meta Title" class="form-control"><?php echo $meta_title ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Please enter Meta Description" class="form-control"><?php echo $meta_desc ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Please enter Meta Keywords" class="form-control"><?php echo $meta_keyword ?></textarea>
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