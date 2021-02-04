<?php
require('includes/top.inc.php');
isAdmin();


if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'status') {

        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = '1';
        } else if ($operation == 'deactive') {
            $status = '0';
        } else {
            echo "Wrong Input";
        }

        $sql_update_status = "UPDATE banner SET status='$status' WHERE id='$id'";
        mysqli_query($con, $sql_update_status);
    }
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $image = rand(111111111, 999999999) . '_' . $_FILES['file']['name'];

    $res = mysqli_query($con, "SELECT * FROM banner WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    unlink("../media/slider/" . $row['image']);



    $destFile = "../media/slider/" . $image;
    move_uploaded_file($_FILES['file']['tmp_name'], $destFile);
    chmod($destFile, 0755);

    mysqli_query($con, "UPDATE banner SET image='$image' WHERE id='$id'");
}
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Offer Banner</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th id="1">Priority</th>
                                        <th id="2">Status</th>
                                        <th id="3">Image</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM banner ORDER BY priority ASC";
                                    $res = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['priority'] ?><br>

                                            </td>
                                            <td> <?php
                                                    if ($row['status'] == 1) {
                                                        echo " <a href='?type=status&operation=deactive&id=" . $row['id'] . "'><span class='badge badge-complete'>Active</span></a>&nbsp;";
                                                    } else {
                                                        echo " <a href='?type=status&operation=active&id=" . $row['id'] . "'><span class='badge badge-pending'>Deactive</span></a>&nbsp;";
                                                    } ?>
                                            </td>
                                            <td>
                                                <img style="max-width: 300px !important;" src="<?php echo "../media/slider/" . $row['image'] ?>" />
                                            </td>

                                            <td>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value=" <?php echo $row['id'] ?>">
                                                    <input type="file" id="file" name="file">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm" style="color:white;font-size: 12px;">
                                                        Submit
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    <?php } ?>
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