<?php
require("include/db.php");
unset($_SESSION['logged_user']);
header("Location:index.php");
?>