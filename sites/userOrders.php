<?php
include '../model/User.php';
include '../model/Order.php';
if ($_SESSION['priviliges'] == 2) {
    if (isset($_GET['userid']) && !isset($_GET['status'])) {
        $userInfo = $db->getUserInfo($_GET['userid']);
        $allOrders = $db->showOrders($_GET['userid']);
    }
    ?>
    <div class="container col-md-12">
        <h3><?php echo $userInfo->getUsername(); ?>'s orders</h3>
        <?php
        if ($allOrders == null) {
            echo "no products";
        }
        foreach ($allOrders as $oneOrder) {
            echo"<h4>Order number: $oneOrder</h4>";

            $allProducts = $db->getOrderInfo($oneOrder);
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-md-6">Product name</th>
                        <th class="col-md-6">Amount</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allProducts as $oneProduct) {
                        echo "<tr>";
                        echo "<td>" . $oneProduct->getProduct() . "</td>";
                        echo "<td>" . $oneProduct->getAmount() . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
                echo "</div>";
            } else
                header("location: index.php");
                