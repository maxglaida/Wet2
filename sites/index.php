<?php
// starting the needed session for the pages
session_start();
// including the head and the navigation bar aswell as the database class
include_once '../inc/head.php';
include_once '../inc/navigationclass.php';
include_once '../utility/DB.php';
$db = new DB;


// navigating between the web pages of the shop.
// Each page gets an id sent using xml on a get url method and based on that the page is chosen out of the follopwing list
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
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
        include_once 'voucherManagementmain.php';
    }else if ($_GET['id'] == 9){
        include_once'userOrders.php';
    }elseif ($_GET['id'] == 10) {
        include_once 'shoppingCart.php';
    } else if ($_GET['id'] == 11) {
    include_once 'billDetails.php';
}
} else include_once 'homepage.php';

// including our footer
include_once '../inc/footer.php' ?>

