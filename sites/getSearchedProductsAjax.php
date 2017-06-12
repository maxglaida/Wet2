<?php
include_once '../utility/DB.php';
$db = new DB() ;
// generating the searched items after each time a new letter is inserted
// checking if the string is empty
if(isset($_POST['option_value']) && !empty($_POST['option_value']) ) {
$selected_option=$_POST['option_value'];
$db->getSearchedProducts($selected_option);
//if its empty displaying the items of the first category.
}else { 
$selected_option = 1;
$db->getProductList($selected_option);
}
?>
