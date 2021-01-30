<?php
require('includes/connection.inc.php');
require('includes/function.inc.php');

$aid = get_safe_value($con, $_POST['aid']);

mysqli_query($con, "DELETE FROM `address` WHERE `id`=$aid");
echo "remove";
