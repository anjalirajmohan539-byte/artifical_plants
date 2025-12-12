<?php
$amount = 2153;   // dynamic amount from cart/order
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>UPI Payment</title>

<style>
    body{
        font-family: Arial, sans-serif;
        background:#f5f6fa;
        margin:0;
        padding:15px;
    }
    .container{
        max-width:480px;
        margin:auto;
    }
    .card{
        background:#fff;
        padding:18px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.06);
        margin-bottom:15px;
    }
    .title{
        font-size:20px;
        font-weight:bold;
        margin-bottom:10px;
    }
    input{
        width:100%;
        padding:12px;
        border-radius:8px;
        border:1px solid #ccc;
        margin-top:6px;
        font-size:15px;
    }
    .btn{
        background:#2563eb;
        color:#fff;
        padding:12px;
        border:none;
        border-radius:8px;
        font-size:16px;
        cursor:pointer;
        width:100%;
        margin-top:12px;
    }
    .btn:disabled{
        background:#a1a1aa;
        cursor:not-allowed;
    }
    .pay-btn{
        background:#111;
        color:#fff;
        padding:14px;
        font-weight:bold;
    }
    .success{
        color:#0f9d58;
        margin-top:6px;
    }
    .error{
        color:#d93025;
        margin-top:6px;
    }
</style>
</head>

<body>
<div class="container">

    <div class="card">
        <div class="title">Total Amount</div>
        <h2>₹ <?php echo $amount; ?></h2>
    </div>

    <div class="card">
        <div class="title">UPI Payment</div>

        <label>Enter UPI ID</label>
        <input type="text" id="upi" placeholder="example@bank">

        <button id="verifyBtn" class="btn">Verify UPI ID</button>
        <div id="verifyMsg"></div>

        <form action="test_action.php" method="POST">
            <input type="hidden" name="upi" id="hiddenUpi">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <button type="submit" id="payBtn" class="btn pay-btn" disabled>
                Pay ₹ <?php echo $amount; ?>
            </button>
        </form>
    </div>

</div>


<script>
document.getElementById("verifyBtn").addEventListener("click", function(){

    let upi = document.getElementById("upi").value;

    if(upi.trim() === ""){
        document.getElementById("verifyMsg").innerHTML =
            "<p class='error'>Please enter a UPI ID</p>";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "verify_upi.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if(this.status === 200){
            let response = this.responseText.trim();

            if(response === "valid"){
                document.getElementById("verifyMsg").innerHTML =
                    "<p class='success'>UPI ID Verified ✓</p>";

                document.getElementById("payBtn").disabled = false;
                document.getElementById("hiddenUpi").value = upi;
            }
            else{
                document.getElementById("verifyMsg").innerHTML =
                    "<p class='error'>Invalid UPI ID format</p>";

                document.getElementById("payBtn").disabled = true;
            }
        }
    };

    xhr.send("upi=" + upi);
});
</script>

</body>
</html>













