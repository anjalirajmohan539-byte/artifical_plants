<?php
include('database.php'); 

if(isset($_POST['btn']))
{
    $offerId  = $_POST['type'];
    $productId = $_POST['proId'];
    $status = $_POST['update'];
    $btn = $_POST['btn'];

// if($btn == "Add")
// {
//     $insert = "INSERT INTO product_offers (ProductId, OfferId)
//                VALUES ('$proid', '$offerId')";
//     mysqli_query($conn,$insert);
// }

 if($btn == "Update")
{
    $update = "UPDATE offers 
               SET Status = $status
               WHERE Id = $offerId";
    mysqli_query($conn,$update);
}
else
    {
        header("location:offers.php?productId=$productId");
    }

    if($offerId != 0)
    {
        $insert = "INSERT INTO product_offers 
                   (ProductId, OfferId, Status) 
                   VALUES 
                   ($productId, $offerId, $status)";

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
elseif (isset($_POST['delete'])) 
{
    $id = $_POST['offId'];
    $productid = $_POST['productId'];

    
    $dupdate = "UPDATE product_offers SET IsDeleted = 1 WHERE Id = $id";
    var_dump($dupdate);

    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) 
        {
        echo "Error updating";
    } 
    else 
    {
        header("location:offers.php?productId=$productid");
        exit();
    }
}

?>
