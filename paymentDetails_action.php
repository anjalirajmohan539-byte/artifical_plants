<?php
include('database.php');

if(isset($_POST['btn']))
{
    $product_id = $_POST['proId'];
    
    $method_id = $_POST['ondelivery'];
var_dump($method_id);

foreach($method_id as $id)
{
    $insert = "INSERT INTO `payment_product_method`( `ProductId`, `PaymentMethodId`) VALUES ($product_id,$id)";
    $check = mysqli_query($conn,$insert);
}
header("location:delivery_details.php?productId=$product_id");
}
?>