<?php
include('database.php');
session_start();

if(isset($_SESSION['Id']))
{
    $customerId = $_SESSION['Id'];
}
else
{
    die("Login Required");
}

$shippingDetailsId = $_POST['shippingDetailsId'];
$paymentMethodId   = $_POST['PaymentMethodId'];
$totalPrice        = $_POST['totalprice'];

$cardNumber = isset($_POST['cardno']) ? $_POST['cardno'] : NULL;
$validDate  = isset($_POST['exp']) ? $_POST['exp'] : NULL;
$cvv        = isset($_POST['cvv']) ? $_POST['cvv'] : NULL;
$upiId      = isset($_POST['upiId']) ? $_POST['upiId'] : NULL;

$orderNo = "ORD".rand(1000,9999);

$insertPayment = "INSERT INTO `payment_details`(`CustomerId`, `ShippingDetailsId`, `OrderNo`, `PaymentMethodId`, `CardNumber`, `ValidDate`, `CVV`, `UPIId`, `TotalPrice`, `IsDeleted`) 
                  VALUES($customerId,$shippingDetailsId,$orderNo,$paymentMethodId,$cardNumber,'$validDate',$cvv,'$upiId',$totalPrice,0)";

if(mysqli_query($conn, $insertPayment))
{
    
    $paymentDetailsId = mysqli_insert_id($conn);

    $selectCart = "SELECT * FROM `cart` WHERE `CustomerId` = $customerId AND `IsDeleted` = 0";
    $cartResult = mysqli_query($conn, $selectCart);

    while($cart = mysqli_fetch_assoc($cartResult))
    {
        $productId    = $cart['ProductId'];
        $productCount = $cart['Count'];

        $selectProduct = "SELECT `Price` FROM `add_product` WHERE `Id` = $productId";
        $productResult = mysqli_query($conn, $selectProduct);
        $productData   = mysqli_fetch_assoc($productResult);

        $price = $productData['Price'];

        $itemTotal = $price * $productCount;

        $insertOrderItems = "INSERT INTO `order_items` (`PaymentDetailsId`,`ProductId`,`ProductCount`,`TotalPrice`,`IsDeleted`)
                             VALUES($paymentDetailsId,$productId,$productCount,$itemTotal,0)";
         mysqli_query($conn, $insertOrderItems);
    }

    // Optional: clear cart
    $updateCart = "UPDATE `cart`
                   SET `IsDeleted` = 1
                   WHERE `CustomerId` = $customerId";

    mysqli_query($conn, $updateCart);

    echo "<script>
            alert('Order Placed Successfully');
            window.location='index.php';
          </script>";
}
else
{
    echo "Payment Insert Failed";
}
?>









