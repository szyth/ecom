<?php
session_start();
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
?>
<script>
    location.replace("index.php");
</script>
<?php
die();
?>