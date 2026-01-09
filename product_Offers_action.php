<?php
include('database.php');

if(isset($_POST['btn']))
{
    $productId = $_POST['proId'];
    $name = $_POST['offerName'];
    $type = $_POST['offerType'];
    $code = $_POST['offerCode'];
    $status = $_POST['Status'];
    $discountType = $_POST['discountType'];
    $discountValue = $_POST['discountvalue'];

    $select = "SELECT `Id`  FROM `product_offers` WHERE `ProductId` = $productId";
    // var_dump($select);
    if(!$check1 = mysqli_query($conn,$select))
    {
        echo "error1";
    }
    else
    {
        $insert = "INSERT INTO `product_offers`( `ProductId`, `OfferName`, `OfferType`, `OfferCode`, `DiscountType`, `DiscountValue`, `Status`) 
                   VALUES ($productId,'$name',$type,$code,$discountType,$discountValue,$status)";
                   var_dump($insert);
        $check = mysqli_query($conn,$insert);

        if(!$check)
        {
            echo "error2";
        }
        else
        {
            header("location:product_Offers.php?productId=$productId");
        }
    }
}
?>