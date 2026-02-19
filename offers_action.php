<?php
include('database.php'); 

if(isset($_POST['btn']))
{
    $offerId  = $_POST['type'];
    $productId = $_POST['proId'];
    $status = $_POST['update'];

    if($offerId != 0)
    {
        $insert = "INSERT INTO product_offers 
                   (ProductId, OfferId, Status) 
                   VALUES 
                   ('$productId', '$offerId', 1)";

        if(mysqli_query($conn, $insert))
        {
            header("location:offers.php?productId=$productId");
        }
        else
        {
            echo "Error: " . mysqli_error($conn);
        }
    }
    else
    {
        echo "Please Select Offer";
    }
}
?>
