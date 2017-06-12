<?php

class navigation {

    function loadXML($who) {
        $xml = simplexml_load_file('../config/navigation.xml');
        if ($who == "visitor") {
            foreach ($xml->visitor->menu as $element) {
                echo '<li><a href="' . $element->link . '">' . $element->title . '</a></li>';
            }
        } elseif ($who == "user") {
            foreach ($xml->user->menu as $element) {
                echo '<li><a href="' . $element->link . '">' . $element->title . '</a></li>';
            }
        } elseif ($who == "admin") {
            foreach ($xml->admin->menu as $element) {
                echo '<li><a href="' . $element->link . '">' . $element->title . '</a></li>';
            }
        }
    }

}
?>



<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Veggies</a>
        <ul class="nav navbar-nav">

<?php
if (isset($_SESSION['priviliges'])) {
    if ($_SESSION['priviliges'] == 1) {
        $who = 'user';
    } else
        $who = 'admin';
} else
    $who = 'visitor'; //   später dynamisch--> entweder visitor, user oder admin


$nav = new Navigation();
$nav->loadXML($who);
?>
        </ul>
        <div class="droppable">
            <ul id="warenkorb" class="nav navbar-nav navbar-right">
                <li role="presentation"><a href="index.php?id=10">Shopping Cart  <span class="badge"><?php if (isset($_SESSION['amount'])) echo $_SESSION['amount']; ?></span></a></li>
                <div>

            </ul>
        </div>

</nav>
