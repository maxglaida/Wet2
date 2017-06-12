<?php
include '../model/User.php';
if ($_SESSION['priviliges'] == 2) {


    $userInfo = $db->getUserInfo($_GET['userid']);
    if (isset($_GET['productid']) && isset($_GET['orderid'])) {
        $db->deleteProduct($_GET['productid'], $_GET['orderid']);
    }
    ?>
    <div class="container col-md-12">
    <h3><?php echo $userInfo->getUsername(); ?>'s orders</h3>
    <?php
    $allOrders = $db->showOrders($_GET['userid']);
    if ($allOrders == null) {
        echo "No orders.";
    }

    foreach ($allOrders as $oneOrder) {

        echo"<h4>Order number: $oneOrder</h4>";

        $allProducts = $db->getProductsByInvoice($oneOrder);
        ?>
        <table class="table">
            <thead>
            <tr>
                <th class="col-md-6">Product name</th>
                <th class="col-md-6">Amount</th>
                <th class="col-md-6"></th>
            </tr>
            </thead>
            <tbody>
        <?php
        foreach ($allProducts as $oneProduct) {
            echo "<tr>";
            echo "<td>" . $oneProduct->getProduct() . "</td>";
            echo "<td>" . $oneProduct->getAmount() . "</td>";
            echo "<td><a href='index.php?id=9&userid=" . $_GET['userid'] . "&orderid=" . $oneOrder . "&productid=" . $oneProduct->getProductid() . "' class='btn btn-primary btn-lg active' role='button'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    echo "</div>";
} else
    header("location: index.php");
                