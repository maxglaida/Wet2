<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
            //Hier wird der Artikel mitsamt Daten gespeichert
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
echo '<li id="warenkorb" class="droppable" role="presentation"><a href="index.php?id=10">Shopping Cart  <span class="badge">'.$_SESSION['amount'].' </span></a></li>';
