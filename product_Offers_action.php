<?php
include('database.php');

if(isset($_POST['btn']))
{
    $name = $_POST['OffersName'];
    $type = $_POST['offerType'];
    $code = $_POST['OffersCode'];
    $status = $_POST['Status'];
    $discountType = $_POST['discountType'];
    $discountValue = $_POST['DiscountValue'];

        $insert = "INSERT INTO `offers`(`OfferName`, `OfferType`, `OfferCode`, `DiscountType`, `DiscountValue`, `Status`) 
                   VALUES ('$name',$type,'$code',$discountType,$discountValue,$status)";
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

?>