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
$upiId      = isset($_POST['upi']) ? $_POST['upi'] : NULL;

$date = date("Y-m-d");
$status = "Pending";



/* ======================================================
   1. INSERT QUERY IN payment_details TABLE
====================================================== */

$paymentQuery = "
INSERT INTO payment_details
(
    customer_id,
    payment_method_id,
    card_number,
    expiry_date,
    cvv,
    upi_id,
    total_amount,
    payment_date,
    status
)
VALUES
(
    '$customerId',
    '$paymentMethodId',
    '$cardNumber',
    '$validDate',
    '$cvv',
    '$upiId',
    '$totalPrice',
    '$date',
    '$status'
)";

mysqli_query($conn, $paymentQuery);

$paymentId = mysqli_insert_id($conn);



/* ======================================================
   2. SELECT QUERY IN cart TABLE
====================================================== */

$cartQuery = "
SELECT * FROM cart
WHERE customer_id = '$customerId'
AND status = 'Cart'
";

$cartResult = mysqli_query($conn, $cartQuery);



/* ======================================================
   3. INSERT QUERY IN order_items TABLE
====================================================== */

while($cartData = mysqli_fetch_assoc($cartResult))
{
    $productId = $cartData['product_id'];
    $quantity  = $cartData['quantity'];
    $price     = $cartData['price'];
    $subtotal  = $quantity * $price;

    $orderQuery = "
    INSERT INTO order_items
    (
        customer_id,
        shipping_details_id,
        payment_id,
        product_id,
        quantity,
        price,
        subtotal,
        order_date,
        order_status
    )
    VALUES
    (
        '$customerId',
        '$shippingDetailsId',
        '$paymentId',
        '$productId',
        '$quantity',
        '$price',
        '$subtotal',
        '$date',
        'Ordered'
    )";

    mysqli_query($conn, $orderQuery);
}



/* ======================================================
   4. UPDATE QUERY IN cart TABLE
====================================================== */

$updateCart = "
UPDATE cart
SET status = 'Ordered'
WHERE customer_id = '$customerId'
AND status = 'Cart'
";

mysqli_query($conn, $updateCart);

echo "Order Placed Successfully";

?>









