<?php
include('database.php');

if (isset($_POST['btn'])) {

    $product_id = $_POST['proId'];
    $method_id = $_POST['ondelivery']; 


    mysqli_query($conn, 
        "DELETE FROM payment_product_method WHERE ProductId = $product_id"
    );


    if (!empty($method_id)) {
        foreach ($method_id as $id) 
        {
            $id = $id;
            mysqli_query($conn,"INSERT INTO payment_product_method (ProductId, PaymentMethodId) VALUES ($product_id, $id)");
        }
    }

    header("Location: delivery_details.php?productId=$product_id");
    exit;
}
?>
