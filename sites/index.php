<?php
session_start();
include_once '../inc/head.php';
include_once '../inc/navigationclass.php';
include_once '../utility/DB.php';
$db = new DB;



if (isset($_GET['id'])) {
    if ($_GET['id'] == 1) {
        include_once 'products.php';
    } elseif ($_GET['id'] == 2) {
        include_once 'register.php';
    } elseif ($_GET['id'] == 3) {
        include_once 'login.php';
    } elseif ($_GET['id'] == 4) {
        include_once 'myAccount.php';
    } elseif ($_GET['id'] == 5) {
        include_once 'logout.php';
    } elseif ($_GET['id'] == 6) {
        include_once 'productManagement.php';
    } elseif ($_GET['id'] == 7) {
        include_once 'userManagement.php';
    } elseif ($_GET['id'] == 8) {
        include_once 'voucherManagement.php';
    }
} else include_once 'homepage.php';


include_once '../inc/footer.php' ?>

