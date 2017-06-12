<?php
include_once '../utility/DB.php';
$db = new DB();
//Get all vouchers from DB
$voucherArray = $db->getAllVouchers();

//Set a timestamp
date_default_timezone_set("Europe/Vienna");
$timestamp = time();
$todaysDate = date("Y-m-d", $timestamp);

//check if the voucher fields are filled correctly
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'submit') {
        if ($_POST['val'] == "" && $_POST['validDate'] == "") {
            echo "please fill in both required fields";
        } elseif ($_POST['val'] != "" && $_POST['validDate'] == "") {
            echo "Please fill in a valid amount of valid days";
        } elseif ($_POST['val'] == "" && $_POST['validDate'] != "") {
            echo "Please fill in the value for the voucher";
        } else {
            $date = date("Y-m-d", time() + 60 * 60 * 24 * $_POST['validDate']);
            $db = new DB();
            $db->setNewVoucher($_POST['val'], $date);
        }
    }
}
?>
<!-- generate the voucher form -->

<div class="col-md-12">
    <div class="col-md-5">
        <form action="index.php?id=8" method="POST">
            <div class="form-group">
                <label for="val">Amount</label>
                <input type="number" name="val" value="" class="form-control" id="val" placeholder="Amount in bitcoins">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Days Valid</label>
                <input type="number" name="validDate" class="form-control" id="validDate" placeholder="Valid days">
            </div>
            <button type="submit" value="submit" name="submit" class="btn btn-default">set new voucher</button>
        </form>
    </div>
    </form>
</div>

<!-- generate all vouchers from db -->

<div class="col-md-12">
    <h2>All stored vouchers in DB</h2>
    <table class="table table-striped">
        <tr>
            <th>Code</th>
            <th>Value</th>
            <th>Valid until</th>
        </tr>

        <?php
        //display all the vouchers from the DB
        foreach ($voucherArray as $voucher) {

            echo "<td>" . $voucher->getCode() . "</td>";
            echo "<td>" . $voucher->getVal() . " $</td>";
            echo "<td>" . $voucher->getValidDate() . "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</div>