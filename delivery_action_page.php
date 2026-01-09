<?php

include("database.php");

if(isset($_POST["btn"]))
{
    $product = $_POST["proId"];
    $return = $_POST["return"];

    $select = "SELECT `Id` FROM `return_details` WHERE ProductId = $product";
    $result = mysqli_query($conn,$select);
    var_dump($select);

    if(mysqli_num_rows($result) > 0)
    {
        echo "error1";
        // exit;
    }

    $insert = "INSERT INTO `return_details`( `ReturnDays`, `ProductId`) VALUES ($return,$product)";
    $statement = mysqli_query($conn,$insert);
    var_dump($insert);

    if(mysqli_num_rows($statement) > 0)
    {
        echo "error2";
        exit;
    }
    header("location:delivery_details.php?productId=$product");
        
}
?>