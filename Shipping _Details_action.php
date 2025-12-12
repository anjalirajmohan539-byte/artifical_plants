<?php
include('database.php');

if(isset($_POST['btn'])){

    $product = $_POST['proId'];
    $available = $_POST['available'];
    $deliveryday = $_POST['dday'];
    $charge = $_POST['charge'];

    
    $check = "SELECT Id FROM shipping_details WHERE ProductId = $product";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){
        echo "error1";  
        exit;
    }

    
    $insert = "INSERT INTO shipping_details (ProductId, AvailabilityId, DeliveryDays, Deliverycharge)
               VALUES ($product, $available, $deliveryday, $charge)";

    if(!mysqli_query($conn, $insert)){
        echo "Error2 ";
        exit;
    }

    
    header("location:delivery_details.php?productId=$product");
    exit;
}
?>

