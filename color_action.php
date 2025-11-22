<?php
include('database.php');

if(isset($_POST['btn']))
{
    $pid = $_POST['productId'];
    $color = $_POST['color'];
    $code = $_POST['colorCode'];
    $status = $_POST['colorStatus'];

    $select = "SELECT `ProductId` FROM `product_color_details` WHERE ProductId = $pid AND IsDelete = 0 AND (ColorName='$color' OR ColorCode='$code')";
    $statemnt = mysqli_query($conn, $select);

    if(mysqli_num_rows($statemnt) > 0)
    {
        echo "Color already exists for this product";
        exit;
    }

    // INSERT COLOR
    $insert = "INSERT INTO `product_color_details`(`ProductId`, `ColorCode`, `ColorName`,`Status`) 
               VALUES ($pid,'$code','$color',$status)";
    $insert_statemnt = mysqli_query($conn, $insert);

    if(!$insert_statemnt)
    {
        echo "Error inserting into product_color_details";
        exit;
    }
    else
    {
        header("location:color.php?productId=$pid");
    }
}

?>