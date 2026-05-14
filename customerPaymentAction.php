<?php
include('database.php');

if(isset($_POST['btn']))
    {
        $cardno = $_POST['btn'];
        $exp = $_POST['exp'];
        $cvc = $_POST['cvc'];
        $upiId = $_POST['upiId'];
    }
?>