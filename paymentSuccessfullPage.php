<?php
include('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="bootstrap/bootstrap.min(css).css" rel="stylesheet">
    <link href="css/paymentSuccessfullPage.css" rel="stylesheet">
</head>
<body>

    <main>
        

        <section class="success-section">
            <div class="icon-circle">
                <i class="fa-solid fa-check"></i>
            </div>
             <?php
        $select = "SELECT `ProductImage`, `ProductName`,ap. `Price`, `MaterialTypeId`, pd.OrderNo, pd.CreateDate, cd.Email, sd.Deliverycharge, off.DiscountValue, off.DiscountType  FROM `add_product` ap
                    LEFT JOIN shipping_details sd ON sd.ProductId = ap.Id
                    LEFT JOIN payment_details pd ON pd.ShippingDetailsId = sd.Id
                    LEFT JOIN order_items ot ON ot.PaymentDetailsId = pd.Id
                    LEFT JOIN product_offers po ON po.ProductId = ap.Id
                    LEFT JOIN offers off ON off.Id = po.OfferId
                    LEFT JOIN customer_details cd ON cd.CustomerId = pd.CustomerId
                   WHERE ap.`IsDeleted` = 0 AND ot.ProductId = 2";

        $check = mysqli_query($conn,$select);

        if(mysqli_num_rows($check)>0)
            {
                $data = mysqli_fetch_assoc($check);

                 $date = new DateTime($data['CreateDate']);
        ?>
            <h1>Payment Successful!</h1>
            <p class="subtitle">Thank you for your purchase. We have received your order.</p>
            
            <div class="order-number">
                Order #<?php echo $data['OrderNo'];?>
            </div>

            <p class="subtitle" style="font-size: 0.9rem; margin-bottom: 1.5rem;">
                A confirmation email has been sent to <strong><?php echo $data['Email'];?></strong>.
            </p>

            <button class="btn" name="btn" style="margin-top: 1.5rem;">←&emsp;Continue Shopping</button>

        </section>


        <aside class="order-summary">
            <div class="summary-header">
                <h2>Order Summary</h2>
                <span style="font-size: 0.85rem; color: var(--text-muted);"><?php echo $date->format('M d,Y');?></span>
            </div>

            <div class="summary-items">
                <?php
                while($details = mysqli_fetch_assoc($check))
                    {
                       
                           $price = $details['Price'];

                           $discountType = $details['DiscountType'] ?? null;
                        $discountValue = $details['DiscountValue'] ?? 0;
                        $deliverCharge = $details['Deliverycharge'] ?? 0;

                        if ($discountType == "Percentage") 
                            {
                                $discountAmount = ($price * $discountValue) / 100;
                                } else {
    $discountAmount = $discountValue;
}

// Final price per item
$finalPrice = $price - $discountAmount;
if ($finalPrice < 0) {
    $finalPrice = 0;
}

// 👉 Multiply by quantity
$itemTotalPrice = $price;
$itemDiscount = $discountAmount;
$itemDelivery = $deliverCharge;
$finalTotalPrice = $finalPrice;

// 👉 Add to totals
$totalPrice += $itemTotalPrice;
$totalDiscount += $itemDiscount;
$totalCharge += $itemDelivery;
$grandprice = $totalPrice - $totalDiscount + $totalCharge;

                ?>
                <div class="item">
                    <img src="images/product/<?php echo $details['ProductImage'];?>" alt="Product" class="item-image">
                    <div class="item-details">
                        <span class="item-name"><?php echo $details['ProductName'];?></span>
                        <span class="item-meta">Material : <?php echo $details['MaterialTypeId'];?></span>
                    </div>
                    <span class="item-price">₹<?php echo $details['Price'];?></span>
                </div>
            </div>

            <div class="divider"></div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹.00</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>₹.00</span>
            </div>
            <div class="summary-row">
                <span>Discount (15)</span>
                <span>₹.00</span>
            </div>

            <div class="summary-row total">
                <span>Total Paid</span>
                <span>₹.00</span>
            </div>

        </aside>
<?php }}?>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Milon Inc. All rights reserved.</p>
    </footer>

</body>
</html>