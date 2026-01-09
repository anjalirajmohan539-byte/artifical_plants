<?php
include("database.php");

if(isset($_POST["btn"]))
{
    $productId = $_POST["prodId"];
    $width = $_POST["Width"];
    $height = $_POST["Height"];
    $weight = $_POST["Weight"];

    $select = "SELECT `Id` FROM `product_dimensions` WHERE `ProductId` = $productId";
    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0)
    {
        echo "error1";
        exit;
    }

    $insert = "INSERT INTO `product_dimensions`( `ProductId`, `Width`, `Height`, `Weight`) VALUES ($productId,'$width','$height','$weight')";
    $statmnt = mysqli_query($conn,$insert);

    if(mysqli_num_rows($statmnt) > 0)
    {
        echo "error2";
        exit;
    }

    header("location:delivery_details.php?productId=$productId");
    
}
?>