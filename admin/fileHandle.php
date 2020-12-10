<?php
require('includes/connection.inc.php');

$file = $_FILES['file'];
if (!empty($file)) {
    $mime_type = mime_content_type($_FILES['file']['tmp_name']);

    $isValid = true;
    $allowed_file_types = ['image/png', 'image/jpeg', 'image/jpg'];
    if (!in_array($mime_type, $allowed_file_types)) {
        echo  "Not Supported";
        return;
    }
    $destFile = '../media/product/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $destFile);
    chmod($destFile, 0755);
    echo  "Success!";
} else {
    echo "Failed";
}
