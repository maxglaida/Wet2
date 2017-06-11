<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$amount = $_POST['amount'];
$p_id=$_POST['p_id'];


if(isset($_POST['p_id'])&&isset($_POST['amount'])&&$_POST['p_id']!=""&&$_POST['amount']!="")
{
    $Anzahl;
    if(is_int($_POST['amount']))
    {
        $Anzahl= $_POST['amount'];
    }
    else{
        $Anzahl = (int) $_POST['amount'];
    }
    if($_POST['amount']>0)
    {
        if(isset($_SESSION['wk'][$_POST['p_id']])&&$_SESSION['wk'][$_POST['p_id']]!=null)
        {

            $_SESSION['wk'][$_POST['p_id']] += $Anzahl;

        }
        else{
            //Hier wird der Artikel mitsamt Daten gespeichert
            $_SESSION['wk'][$_POST['p_id']] = $Anzahl;

        }

        if(isset($_SESSION['Anz']))
        {
            $_SESSION['Anz']+=$Anzahl;

        }
        else{
            $_SESSION['Anz'] = $Anzahl;

        }
    }
}
echo '<li id="warenkorb" class="droppable" role="presentation"><a href="#">Shopping Cart  <span class="badge">'.$_SESSION['Anz'].' </span></a></li>';
