<?php
include('database.php');

if(isset($_POST['btn']))
{
    $name = $_POST['OffersName'];
    $type = $_POST['offerType'];
    $code = $_POST['OffersCode'];
    $startingDate = $_POST['starting_date'];
    $endingDate = $_POST['ending_date'];
    $status = $_POST['Status'];
    $discountType = $_POST['discountType'];
    $discountValue = $_POST['DiscountValue'];

if(isset($_POST['update']))
{
    $id = $_POST['update_id'];
    $name = $_POST['OffersName'];
    $status = $_POST['Status'];

    $updateQuery = "UPDATE offers SET 
                    OfferName='$name',
                    Status='$status'
                    WHERE Id='$id'";

    mysqli_query($conn, $updateQuery);
}
else
    {

        $insert = "INSERT INTO `offers`(`OfferName`, `OfferType`, `OfferCode`, `DiscountType`, `DiscountValue`, `StartingDate`, `EndingDate`, `Status`) 
                   VALUES ('$name',$type,'$code',$discountType,$discountValue,$startingDate,$endingDate,$status)";
                   var_dump($insert);
        $check = mysqli_query($conn,$insert);

        if(!$check)
        {
            echo "error2";
        }
        else
        {
            header("location:product_Offers.php");
        }
    }
    }

    elseif(isset($_POST['delete']))
    {
    $delete_id = $_POST['delete_id'];

    $deleteQuery = "UPDATE offers SET IsDelete = 1 WHERE Id='$delete_id'";
    mysqli_query($conn, $deleteQuery);

    header('location:product_Offers.php');
}
    

?>