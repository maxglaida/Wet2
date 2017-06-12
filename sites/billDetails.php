<?php

if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_GET['orderid'])) {
    $bill = $db->getOrderInfo($_GET['orderid']);

    echo "<div class='col-md-12 container'>";
    echo "<h3>Details of invoice nr. " . $_GET['orderid'] . " from " . $bill->getDatum() . ", paid using " . $bill->getPayMethod() . ".</h3>";

    echo "</div>";
    echo "<h4>Products included: </h4>";

    $allProducts = $db->getProductsByInvoice($_GET['orderid']);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th class="col-md-6">Product name</th>
                <th class="col-md-6">Amount</th>
                <th class="col-md-6"></th>
            </tr>
        </thead>

        <?php

        echo"<tbody>";
        foreach ($allProducts as $oneProduct) {
            echo "<tr>";
            echo "<td>" . $oneProduct->getProduct() . "</td>";
            echo "<td>" . $oneProduct->getAmount() . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else
        header("location: index.php")
        ?>
