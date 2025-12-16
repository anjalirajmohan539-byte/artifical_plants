<?php

include('database.php');

if(isset($_POST['btn']))
{
    $productId = $_POST['product'];
    $return = $_POST['return'];
    $payment = $_POST['ondelivery'];
    $customer = $_POST['customer'];

    $select = "SELECT `Id` FROM `delivery_details` WHERE ProductId = $productId";
    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0)
    {
        echo "error1";
        exit;
    }

    $insert = "INSERT INTO `delivery_details`(`ProductId`, `ReturnDays`, `PaymentMode`, `TotalAmount`) 
               VALUES ($productId,$return,$payment,[value-4])";
    $statemnt = mysqli_query($conn,$insert);

    if(mysqli_num_rows($statemnt)>0)
    {
        echo "error2";
        exit;
    }

    header("locaton:delivery_details.php?$productId");
    exit;
}
?>