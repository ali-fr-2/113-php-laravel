<?php
include "./login.php";
session_start();
include "./database/pdo_connection.php";
session_destroy();
setcookie("phone", $user['phone'], time()-1);
header("location:login.php");
exit;
