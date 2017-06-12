<?php
session_start();
include_once '../utility/DB.php';
$db = new DB();
if (isset($_POST['toDo']) && $_POST['toDo'] != "" && isset($_POST['pid']) && $_POST['pid'] != "") {
    $ProduktID = $_POST['pid'];
    if (isset($_SESSION['cart'][$ProduktID])) {
        if ($_POST['toDo'] == 'deleteProduct') {
            unset($_SESSION['cart'][$ProduktID]);
            $_SESSION['amount'] -=1;
        } elseif ($_POST['toDo'] == '+') {
            $_SESSION['cart'][$ProduktID] += 1;
        } elseif ($_POST['toDo'] == '-') {
            if ($_SESSION['cart'][$ProduktID] > 0) {
                $_SESSION['cart'][$ProduktID] -= 1;
            } else {
                unset($_SESSION['cart'][$ProduktID]);
            }
        }
    }
}

echo "<table class='table table-striped'>";
echo "<th>Product Name</th><th>Bild</th><th>Price</th><th>amount</th><th>Price</th><th></th>";

$sum = 0;
 if (isset($_SESSION['cart'])) {       
        foreach ($_SESSION['cart'] as $id => $amount) {
        echo "<tr>";
        $db = new DB();
        $Products = $db->getProducts($id);
        
        echo "<td>" . $Products->getName() . "</td>";
        echo "<td><img name='" . $Products->getId() . "' id='picture' src='../" . $Products->getPicture() . "'></td>";
        echo "<td>" . $Products->getPrice() . "</td>";
        echo "<td>" . $amount . "</td>";
        echo "<td>" . $Products->getPrice() * $amount . "</td>";
        echo "<td><div ><input type='hidden' name='p_id' value='" . $Products->getId() . "'>"
        . "<input type='submit' name='toDo' onclick='cartManagement(\"deleteProduct\",$id)' value='Löschen' class='actionCart btn btn-default'><input type='submit' onclick='cartManagement(\"+\",$id)' name='toDo' value='+' class='actionCart btn btn-default'>"
        . "<input type='submit' onclick='cartManagement(\"-\",$id)' name='toDo' value='-' class='actionCart btn btn-default'>"
        . "<input type='submit' name='toDo' value='Order' class='actionCart btn btn-default'></div></td>";

        $sum += $Products->getPrice() * $amount;

        echo "<tr>";
        
        }
    echo "<tr><td></td><td></td><td></td><th>Total order price:</th><th>" . $sum . "</th><td></td></tr>";
}
echo "</table>";

