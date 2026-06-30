<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 3) {
    die("Access Denied");
}