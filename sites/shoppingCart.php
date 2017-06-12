<?php
// check if the session is already set
if (isset($_SESSION['cart'])) {
?><div id='ccart'><?php
    // echo our shopping cart structure
echo "<table class='table table-striped'>";
echo "<th>Product Name</th><th>Bild</th><th>Price</th><th>amount</th><th>Price</th><th></th>";

$sum = 0;
        // echo each item which exist in the shopping cart with the amount.
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
        . "<input type='submit' name='toDo' onclick='cartManagement(\"deleteProduct\",$id)' value='remove' class='actionCart btn btn-default'><input type='submit' onclick='cartManagement(\"+\",$id)' name='toDo' value='+' class='actionCart btn btn-default'>"
        . "<input type='submit' onclick='cartManagement(\"-\",$id)' name='toDo' value='-' class='actionCart btn btn-default'>"
        . "<input type='submit' name='toDo' value='Order' class='actionCart btn btn-default'></div></td>";
        // calculate the total price
        $sum += $Products->getPrice() * $amount;

        echo "<tr>";
        
        }
        // echo total price
    echo "<tr><td></td><td></td><td></td><th>Total order price:</th><th>" . $sum . "</th><td></td></tr>";

echo "</table>";
}

?>
</div>