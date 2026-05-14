<?php 
include('database.php');
include('header.php');

$totalPrice = 0;
$totalDiscount = 0;
$totalCharge = 0;
?>
<link href="css/customerPayment.css" rel="stylesheet">
    <div class="container main">
        
        <!-- LEFT COLUMN: Form Details -->
        <main class="checkout-form">

            <!-- Shipping Address -->
            <section class="card">
                <?php
                $select = "SELECT cd.`Id`, `FullName`, `PhoneNo`, `Address`, `City`, st.Name AS `State`, `PinCode`  FROM `customer_details` cd
                           INNER JOIN state st ON st.Id = cd.State
                           WHERE `CustomerId` = $Id AND cd.`IsDeleted` = 0";
                $check = mysqli_query($conn,$select);

                if(mysqli_num_rows($check)>0)
                    {
                        $details = mysqli_fetch_assoc($check);
                    
                ?>
                <h2 class="section-title"><span class="step-number">2</span> Shipping Address</h2>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" value="<?php echo $details['FullName'];?>" disabled style="color: gray;">
                    </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" value="<?php echo $details['Address'];?>" disabled style="color: gray;">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" value="<?php echo $details['City'];?>" disabled style="color: gray;">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" value="<?php echo $details['State'];?>" disabled style="color: gray;">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>PIN Code</label>
                        <input type="text" value="<?php echo $details['PinCode'];?>" disabled style="color: gray;">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" value="<?php echo $details['PhoneNo'];?>" disabled style="color: gray;">
                    </div>
                </div>
                <?php }?>
            </section>


               <!-- RIGHT COLUMN: Order Summary -->
        
            <div class="card">
                <?php

                    $totalPrice = 0;
                    $totalDiscount = 0;
                    $totalCharge = 0;
                    
                    $selectcart = "SELECT ap.`Id` AS ProductId, ca.Id AS cartId, ap.`Price`, off.DiscountValue, sd.`Deliverycharge`, off.`DiscountType`, ca.Count
                                   FROM `add_product` ap
            LEFT JOIN cart ca ON ca.ProductId = ap.Id
            LEFT JOIN product_availability pa ON pa.Id = ap.Availability
            LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
            LEFT JOIN offers off ON off.Id = pf.OfferId
            LEFT JOIN shipping_details sd ON sd.ProductId = ap.Id
            WHERE ca.`Status` = 0 
            AND ca.CustomerId = $Id";

$check2 = mysqli_query($conn,$selectcart);

$count = mysqli_num_rows($check2);

if($count > 0)
{
    while($deta = mysqli_fetch_assoc($check2))
    {

        $price = $deta['Price'];
        $countQty = $deta['Count'];

        $discountType = $deta['DiscountType'] ?? null;
        $discountValue = $deta['DiscountValue'] ?? 0;
        $deliverCharge = $deta['Deliverycharge'] ?? 0;

        // Discount Calculation
        if ($discountType == "Percentage") {
            $discountAmount = ($price * $discountValue) / 100;
        } else {
            $discountAmount = $discountValue;
        }

        // Final price
        $finalPrice = $price - $discountAmount;

        if ($finalPrice < 0) {
            $finalPrice = 0;
        }

        // Item totals
        $itemTotalPrice = $price * $countQty;
        $itemDiscount = $discountAmount * $countQty;
        $itemDelivery = $deliverCharge * $countQty;

        // Add totals
        $totalPrice += $itemTotalPrice;
        $totalDiscount += $itemDiscount;
        $totalCharge += $itemDelivery;
    }

    // Grand Total
    $grandprice = $totalPrice - $totalDiscount + $totalCharge;
?>

    <h3 style="margin-bottom: 1.5rem;">Amount</h3>

    <div class="divider"></div>

    <div class="summary-item">
        <span class="text-gray">Subtotal (<?php echo $count; ?> items)</span>
        <span>₹<?php echo $totalPrice; ?>.00</span>
    </div>

    <div class="summary-item">
        <span class="text-gray">Discount</span>
        <span>- ₹<?php echo $totalDiscount; ?>.00</span>
    </div>

    <div class="summary-item">
        <span class="text-gray">Shipping Charge</span>
        <span>+ ₹<?php echo $totalCharge; ?>.00</span>
    </div>

    <div class="divider"></div>

    <div class="total-row">
        <span>Total</span>
        <span>₹<?php echo $grandprice; ?>.00</span>
    </div>

<?php
}
?>

</div> 
        </main>
            <!-- Payment -->
             <aside class="order-summary">
                <form action="customerPaymentAction.php" method="post">
            <section class="card">
                <h2 class="section-title"><span class="step-number">3</span> Payment</h2>
                
                <div class="payment-tabs">
                    <div class="tab active" onclick="switchTab('card')">Credit Card</div>
                    <div class="tab" onclick="switchTab('delivery')">Cash On Delivery</div>
                    <div class="tab" onclick="switchTab('upi')">UPI</div>
                </div>

                <!-- Credit Card Form -->
                <div id="card-form">
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="cardno" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiration (MM/YY)</label>
                            <input type="text" name="exp" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label>Security Code (CVC)</label>
                            <input type="text" name="cvc" placeholder="123">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name on Card</label>
                        <input type="text" placeholder="John Doe">
                    </div>
                </div>

                <!-- delivery Placeholder -->
                <div id="delivery-form" style="display: none; text-align: center; padding: 2rem;">
                    <p>You will be redirected to cash on delivery to complete your purchase securely.</p>
                </div>

                <!-- UPI Placeholder -->
                <div id="upi-form" style="display: none; padding: 2rem;">

                <div class="form-group">
                    <label>UPI ID</label>
                <input type="text" name="upiId" placeholder="example@upi">
                </div>

                <div class="form-group">
                    <label>Account Holder Name</label>
                <input type="text" placeholder="John Doe">
                </div>

</div>

                <button class="btn" name="btn" style="margin-top: 1.5rem;">Pay Now   ₹<?php echo $grandprice;?>.00</button>
                
                <div class="secure-checkout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Transactions are secure and encrypted.
                </div>
            </section>
            </form>
</aside>
    </div>
<?php
include('footer.php');
?>
    <script>
    // Payment tab switch script
    function switchTab(method) {

        const cardForm = document.getElementById('card-form');
        const deliveryForm = document.getElementById('delivery-form');
        const upiForm = document.getElementById('upi-form');

        const tabs = document.querySelectorAll('.tab');

        // Hide all forms first
        cardForm.style.display = 'none';
        deliveryForm.style.display = 'none';
        upiForm.style.display = 'none';

        // Remove active class from all tabs
        tabs.forEach(tab => tab.classList.remove('active'));

        // Show selected form
        if (method === 'card') {
            cardForm.style.display = 'block';
            tabs[0].classList.add('active');

        } else if (method === 'delivery') {
            deliveryForm.style.display = 'block';
            tabs[1].classList.add('active');

        } else if (method === 'upi') {
            upiForm.style.display = 'block';
            tabs[2].classList.add('active');
        }
    }
</script>

</body>
</html>