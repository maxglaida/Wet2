<div class="col-md-5">
<form action="" method="POST">
  <div class="form-group">
    <label for="val">Amount</label>
    <input type="value" name="val" value="" class="form-control" id="val" placeholder="Amount in bitcoins">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Days Valid</label>
    <input type="number" name="validDate" class="form-control" id="validDate" placeholder="Valid days">
  </div>
    <button type="submit" value="submit" class="btn btn-default">set new voucher</button>
</form>
</div>
</form>
<?php


include_once '../utility/DB.php';
$db = new DB();
//Aktuelles Datum herausfinden
date_default_timezone_set("Europe/Vienna");
$timestamp = time();
$datum = date("Y-m-d", $timestamp);

//Überprüfen, ob ein Gutschein Gespeichert werden soll, die notwendigen Daten angegeben sind und diesen gegebenenfalls speichern
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'submit') {
        if ($_POST['val'] == "" && $_POST['validDate'] == "") {
            echo "Bitte geben Sie die Anzahl der Gültigkeit und den Wert an!";
        } elseif ($_POST['val'] != "" && $_POST['validDate'] == "") {
            echo "Bitte geben Sie ein gültige Anzahl für die Gültigkeit des Gutscheines an!";
        } elseif ($_POST['val'] == "" && $_POST['validDate'] != "") {
            echo "Bitte geben Sie ein gültigen Wert für den Gutschein an!";
        } else {
            $date = date("Y-m-d", time() + 60 * 60 * 24 * $_POST['validDate']);
            $db = new DB();
            $db->newVoucher($_POST['val'], $date);
        }
    }
}
?>
<!--Daten aller Gutscheine aus der DB holen und mit einer Tabelle darstellen-->
<div class="col-md-8">
    <h2>Übersicht</h2>
<?php
$db = new DB();
$allGutscheine = $db->getAllGutscheine();

//var_dump($allGutscheine);
?>
    <table class="table table-striped">
        <tr>
            <th>
                GutscheinID 
            </th>
            <th>
                Code
            </th>
            <th>
                Wert
            </th>
            <th>
                Restwert
            </th>
            <th>
                Gültigkeit
            </th>
        </tr>
<?php
foreach ($allGutscheine as $gutschein) {
    //Überprüfen, ob der Gutschein abgelaufen ist, wenn ja, dann rot markieren
    if ($gutschein->getDauer() < $datum) {
        echo "<tr class='danger'>";
        //Überprüfen, ob der Gutschein komplett aufgebraucht worden ist, wenn ja gelb markieren
    } elseif ($gutschein->getRestwert() <= 0) {
        echo "<tr class='warning'>";
    } else {
        echo "<tr>";
    }
    echo "<td>" . $voucher->getGutscheinID() . "</td>";
    echo "<td>" . $voucher->getCode() . "</td>";
    echo "<td>" . $voucher->getWert() . "</td>";
    echo "<td>" . $voucher->getDauer() . "</td>";
    echo "</tr>";
}
?>

    </table>
</div>