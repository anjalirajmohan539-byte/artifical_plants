<?php
include('database.php');

if(isset($_POST['btn'])){

    $product = $_POST['proId'];
    $available = $_POST['available'];
    $deliveryday = $_POST['dday'];
    echo $charge =empty($_POST['deliveryCharge']) ? 0 : $_POST['deliveryCharge'];
    $type = $_POST['type'];

    
    $check = "SELECT Id FROM shipping_details WHERE ProductId = $product";
    $result = mysqli_query($conn, $check);
    // var_dump($check);

    if(mysqli_num_rows($result) > 0){
        echo "error1";  
        exit;
    }

    
    $insert = "INSERT INTO shipping_details (ProductId, AvailabilityId, DeliveryDays, DeliveryType,Deliverycharge)
               VALUES ($product, $available, $deliveryday, $type,$charge)";
               var_dump($insert);

    if(!mysqli_query($conn, $insert)){
        echo "Error2 ";
        exit;
    }

    
    header("location:delivery_details.php?productId=$product");
    exit;
}
?>

