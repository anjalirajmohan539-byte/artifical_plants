<?php
include('database.php');

        $paymentId = intval($_GET['paymentproduct']);

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

             $totalCharge = 0;
             $totalDiscount = 0;
             $totalPrice = 0;
        
                //    var_dump($select);
$select1 = "SELECT  `OrderNo`, `Email`  FROM `payment_details` pd
            INNER JOIN customer_details cd ON cd.CustomerId = pd.CustomerId
            WHERE cd.Status = 1";
        $check = mysqli_query($conn,$select1);

        if(mysqli_num_rows($check)>0)
            {
                $data = mysqli_fetch_assoc($check);
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
<?php }?>
        </section>


        <aside class="order-summary">
            <div class="summary-header">
                <h2>Order Summary</h2>
                <span style="font-size: 0.85rem; color: var(--text-muted);"></span>
            </div>

            <div class="summary-items">
                <?php
                $select = "SELECT `ProductImage`, `ProductName`,ap. `Price`,mt.Name AS `MaterialTypeId`, pd.OrderNo,  DATE_FORMAT(pd.CreateDate, '%M %d,%Y') AS createDate, ifnull(sd.Deliverycharge,0) AS DeliveryCharge, ifnull(off.DiscountValue,0) AS DiscountValue
FROM `order_items` ot
                    INNER JOIN add_product ap ON ap.Id = ot.ProductId
                    INNER JOIN material_type mt ON mt.Id = ap.MaterialTypeId
                    INNER JOIN payment_details pd ON pd.Id = ot.PaymentDetailsId
                    LEFT JOIN shipping_details sd ON sd.ProductId = ap.Id
                    LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
                    LEFT JOIN offers off ON off.Id = pf.OfferId
                   WHERE ap.`IsDeleted` = 0 AND pd.Id = $paymentId"; 
                   
                   $check1 = mysqli_query($conn,$select);

                   if(mysqli_num_rows($check1)>0)
                    {
                while($details = mysqli_fetch_assoc($check1))
                    {
                       
                           $price = $details['Price'];

                           $discountType = $details['DiscountType'] ?? null;
                        $discountValue = $details['DiscountValue'] ?? 0;
                        $deliverCharge = $details['DeliveryCharge'] ?? 0;

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
                <?php }?>
            </div>

            <div class="divider"></div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹<?php echo number_format($totalPrice, 2)?></span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>₹<?php echo number_format($totalCharge, 2)?></span>
            </div>
            <div class="summary-row">
                <span>Discount</span>
                <span>₹<?php echo number_format($totalDiscount, 2)?></span>
            </div>

            <div class="summary-row total">
                <span>Total Paid</span>
                <span>₹<?php echo number_format($grandprice, 2)?></span>
            </div>
<?php }?>
        </aside>

    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Milon Inc. All rights reserved.</p>
    </footer>

</body>
</html>