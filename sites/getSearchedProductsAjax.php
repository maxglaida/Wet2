<?php
include_once '../utility/DB.php';
$db = new DB() ;

if(isset($_POST['option_value']) && !empty($_POST['option_value']) ) {
$selected_option=$_POST['option_value'];
$db->getSearchedProducts($selected_option);
}else { 
$selected_option = 1;
$db->getProductList($selected_option);
}
?>
