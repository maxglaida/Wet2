<?php
$selected_option=$_POST['option_value'];

include_once '../utility/DB.php';
$db = new DB();

$db->getSearchedProducts($selected_option);
?>
