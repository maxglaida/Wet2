<?php

class navigation{
// creating a navigation class.

// the load xml function is triggered and based on the parameter that was passed from the session it is decided which menu to display
    function loadXML($who){
        $xml = simplexml_load_file('../config/navigation.xml');
        if($who=="visitor"){
            foreach($xml->visitor->menu as $element){
                echo '<li><a href="'.$element->link.'">'.$element->title.'</a></li>';
            }
        }
        elseif($who=="user"){
            foreach($xml->user->menu as $element){
                echo '<li><a href="'.$element->link.'">'.$element->title.'</a></li>';
            }
        }
        elseif($who=="admin"){
            foreach($xml->admin->menu as $element){
                echo '<li><a href="'.$element->link.'">'.$element->title.'</a></li>';
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
        //checking who is the user
        if(isset($_SESSION['priviliges'])) {
            if($_SESSION['priviliges'] == 1) {
                $who = 'user';
            } else
                $who = 'admin';
        }else $who = 'visitor';

        // creating a new navigation object and loading the xml.
        $nav = new Navigation();
        $nav->loadXML($who);
        //  generating the shopping cart icon with the amount of items that currently exist in the session.
        ?>
    </ul>
    <div class="droppable">
    <ul id="warenkorb" class="nav navbar-nav navbar-right">
            <li role="presentation"><a href="index.php?id=10">Shopping Cart  <span class="badge"><?php if(isset($_SESSION['amount'])) echo $_SESSION['amount']; ?></span></a></li>
    <div>

    </ul>
</div>

</nav>
