<?php


if(isset($_POST['upi'])){
    $upi = trim($_POST['upi']);

    // UPI format: name@bank
    if(preg_match("/^[a-zA-Z0-9.\-_]{2,}@[a-zA-Z]{2,}$/", $upi)){
        echo "valid";
    } else {
        echo "invalid";
    }
}


if(isset($_POST['upi']) && isset($_POST['amount'])){

    $upi = $_POST['upi'];
    $amount = $_POST['amount'];

    echo "<h2>Payment Processing...</h2>";
    echo "<p>UPI ID: <b>$upi</b></p>";
    echo "<p>Amount: <b>₹ $amount</b></p>";

    // Here you integrate with Razorpay / PhonePe / Paytm API
}
else{
    echo "Invalid Request";
}

?>