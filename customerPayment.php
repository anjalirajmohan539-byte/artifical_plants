<?php
include('header.php');
?>

<link rel="stylesheet" href="css/customerPayment.css">

<div class="container">
    
    <!-- Left Side -->
    <div class="left-panel">
        <h4>Complete Payment</h4>

        <div class="payment-options">
            <p class="active" onclick="showMethod('card')">💳 Credit / Debit / ATM Card</p>
            <p onclick="showMethod('upi')">UPI</p>
            <p onclick="showMethod('cod')">💵 Cash on Delivery</p>
            <p onclick="showMethod('gift')">🎁 Have a Gift Card</p>
            <p class="disabled" disabled>EMI</p>
        </div>
    </div>

    <!-- Middle Card Form -->
    <div class="card-form">
        <h4>Enter Details</h4>
<div id="card" class="payment-form">
  <h4>Enter Card Details</h4>
    <input type="text" placeholder="Card Number">
    <input type="text" placeholder="MM/YY">
    <input type="text" placeholder="CVV">
    </div>

    <!-- COD -->
<div id="cod" class="payment-form hidden">
    <h4>Cash on Delivery</h4>
    <p>No details required. Pay online now for safe and contactless delivery.</p>
</div>

<!-- UPI -->
<div id="upi" class="payment-form hidden">
    <h4>UPI</h4>
    <div class="upi">
    <input type="radio" class="upi" name="upi">
    <h2>Google&nbsp;Pay</h2>
    <input type="radio" class="upi" name="upi">
    <h2>PhonePe</h2>
    <input type="radio" class="upi" name="upi">
    <h2>Paytm</h2>
    </div>
    <input type="text" placeholder="Enter UPI ID">
</div>

        <button onclick="payNow()">Pay ₹232</button>

        <!-- GIFT CARD -->
<div id="gift" class="payment-form hidden">
    <h4>Add New Gift Card</h4>
    <input type="text" placeholder="Enter voucher number">
    <input type="text" placeholder="Enter voucher PIN">
    <button>Add Gift Card</button>
</div>
    </div>

    <!-- Right Summary -->
    <div class="summary">
        <h4>Price Details</h4>

        <p>MRP: ₹699</p>
        <p>Platform Fee: ₹7</p>
        <p class="discount">Discount: -₹474</p>

        <hr>

        <h3>Total: ₹232</h3>

        <!-- <div class="cashback">5% Cashback Available</div> -->
    </div>

</div>
<?php include('footer.php');?>

<script>
  function payNow() {
    let card = document.getElementById("cardNumber").value;
    let expiry = document.getElementById("expiry").value;
    let cvv = document.getElementById("cvv").value;
    let error = document.getElementById("cardError");

    error.innerText = "";

    if (card.length < 16) {
        error.innerText = "Card number must be 16 digits";
        return;
    }

    if (expiry === "") {
        alert("Enter expiry date");
        return;
    }

    if (cvv.length !== 3) {
        alert("Invalid CVV");
        return;
    }

    alert("Payment Successful!");
}
</script>

<script>
  function showMethod(method) {

    // hide all forms
    let forms = document.querySelectorAll('.payment-form');
    forms.forEach(form => form.classList.add('hidden'));

    // show selected form
    document.getElementById(method).classList.remove('hidden');
}
</script>
</body>
</html>