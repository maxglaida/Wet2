<?php

if (isset($_SESSION['cart'])) {
?><div id='ccart'><?php
echo "<table class='table table-striped'>";
echo "<th>Product Name</th><th>Bild</th><th>Price</th><th>amount</th><th>Price</th><th></th>";

$sum = 0;
        
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
        . "<input type='submit' onclick='cartManagement(\"-\",$id)' name='toDo' value='-' class='actionCart btn btn-default'></div></td>";

        $sum += $Products->getPrice() * $amount;

        echo "<tr>";
        
        }
    echo "<tr><td></td><td></td><td></td><th>Total order price:</th><th>" . $sum . "</th><td></td></tr>";

echo "</table>";
}

?>
</div>