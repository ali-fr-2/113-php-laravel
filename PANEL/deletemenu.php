<?php 
include "./auth.php";
include "../database/pdo_connection.php";

$result=$conn->prepare("DELETE FROM menus WHERE id=? ");
$result->bindValue(1,$_GET['id']);
$result->execute();

header("location:showmenu.php");

?>