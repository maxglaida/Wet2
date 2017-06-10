<?php

class navigation{

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

    <a href="index.php" class="navbar-brand">Veggies</a>
    <ul class="nav navbar-nav">

        <?php

        if(isset($_SESSION['priviliges'])) {
            if($_SESSION['priviliges'] == 1) {
                $who = 'user';
            } else
                $who = 'admin';
        }else $who = 'visitor'; //   später dynamisch--> entweder visitor, user oder admin


        $nav = new Navigation();
        $nav->loadXML($who);

        ?>


        <li><a href="#"><span class="floatleft glyphicon glyphicon-shopping-cart" id="pullrightnav" aria-hidden="true" title="Shopping Cart"></span></a></li>

    </ul>

</nav>
