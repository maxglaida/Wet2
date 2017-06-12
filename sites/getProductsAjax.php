<?php

// generating a products list based on the category that the user chose. using ajax.
$selected_option=$_POST['option_value'];

include_once '../utility/DB.php';
$db = new DB();
// the function that returns the new echoed list of items.
$db->getProductList($selected_option);
?>
