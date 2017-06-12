<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php
session_start();
include_once '../utility/DB.php';
$db = new DB;
if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $userid = $_GET['userid'];
    $billNr = $db->getBillId($orderid, $userid);
    $allProducts = $db->getProductsByInvoice($orderid);
    foreach ($allProducts as $dummy) {
        $datum = $dummy->getDatum();
    }
    $address = $db->getAddressByUserId($userid);

    echo "<div class='container'>";
    //var_export($address);
    echo "<h2>Bill nr.: $billNr from $datum delivered to " . $address->getAddress() . ", " . $address->getZip() . ", " . $address->getCity() . " </h2>"
    ?><table class="table">
        <thead>
            <tr>
                <th class="col-md-6">Position</th>
                <th class="col-md-6">Product name</th>
                <th class="col-md-6">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nr = 1;
            foreach ($allProducts as $oneProduct) {
                echo "<tr>";
                echo "<td>$nr</td>";
                echo "<td>" . $oneProduct->getProduct() . "</td>";
                echo "<td>" . $oneProduct->getAmount() . "</td>";
                echo "</tr>";
                $nr++;
            }
            echo "</tbody>";

            echo "</table>";


            echo"</div>";
        } else
            header("location: index.php")
            ?>
