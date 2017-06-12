<?php
// starting the sessions
session_start();
// checking if the posted values are valid and already exist or not
if(isset($_POST['p_id'])&&isset($_POST['amount'])&&$_POST['p_id']!=""&&$_POST['amount']!="")
{
    $amount;
    if(is_int($_POST['amount']))
    {
        $amount= $_POST['amount'];
    }
    else{
        $amount = (int) $_POST['amount'];
    }
    if($_POST['amount']>0)
    {
        if(isset($_SESSION['cart'][$_POST['p_id']])&&$_SESSION['cart'][$_POST['p_id']]!=null)
        {

            $_SESSION['cart'][$_POST['p_id']] += $amount;

        }
        else{
            //saving a new product in the session
            $_SESSION['cart'][$_POST['p_id']] = $amount;
            if(isset($_SESSION['amount']))
            {
                $_SESSION['amount']+=$amount;

            }
            else{
                $_SESSION['amount'] = $amount;

            }
            
        }

    }
}
// echoing out the new amount on the shopping cart icon
echo '<li id="warenkorb" class="droppable" role="presentation"><a href="index.php?id=10">Shopping Cart  <span class="badge">'.$_SESSION['amount'].' </span></a></li>';
