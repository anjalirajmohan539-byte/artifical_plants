<?php

include('database.php');
include('header.php');


$totalPrice = 0;
$totalDiscount = 0;
$totalCharge = 0;
?>



    <link rel="stylesheet" href="css/customer_cart.css">

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
     <?php
         $details = "SELECT ap.`Id`, `ProductImage`, `ProductName`, `Description`,ap.`Price`, off.DiscountValue, sd.`Deliverycharge`, off.`DiscountType`,ca.Count, 
                    `ColorName`, `ColorCode`, `CategoryId`, `CategoryTypeId`, `MaterialId`, `MaterialTypeId`, `ProductCount`,pa.Name AS `Availability` FROM `add_product` ap
                    LEFT JOIN cart ca ON ca.ProductId = ap.Id
                    LEFT JOIN product_availability pa ON pa.Id = ap.Availability
                    LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
                    LEFT JOIN offers off ON off.Id = pf.OfferId
                    LEFT JOIN shipping_details sd ON sd.ProductId = ap.Id
                    WHERE ap.`IsDeleted` = 0 AND ca.CustomerId = $Id";
                    // var_dump($details);

        $check2 = mysqli_query($conn,$details);
        $count = mysqli_num_rows($check2);
        if(mysqli_num_rows($check2)>0)
            {
     ?>
    <section class="cart-items">

        <?php

        $select = "SELECT  `Name`, `Pincode` FROM `delivery_customer_details` WHERE `Customer_Id` = $Id AND `status` = 0 AND IsDelected = 0 ";
        // var_dump($select);
        $check = mysqli_query($conn,$select);

        if(mysqli_num_rows($check)>0)
            {
                $cus = mysqli_fetch_assoc($check);
            
        ?>
        <div class="delivery">
            Deliver to: <strong><?php echo $cus['Name'];?>, <?php echo $cus['Pincode'];?></strong>
           <a href="shipping_customer_details.php?customerId=<?php echo $Id;?>"><button class="change-btn">Change</button></a> 
        </div>
<?php }?>
        <!-- Item -->

        <?php
    
                while($deta=mysqli_fetch_assoc($check2))
                    {  
                        $price = $deta['Price'];
$countQty = $deta['Count'];

$discountType = $deta['DiscountType'] ?? null;
$discountValue = $deta['DiscountValue'] ?? 0;
$deliverCharge = $deta['Deliverycharge'] ?? 0;

// Calculate discount
if ($discountType == "Percentage") {
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
$itemTotalPrice = $price * $countQty;
$itemDiscount = $discountAmount * $countQty;
$itemDelivery = $deliverCharge * $countQty;

// 👉 Add to totals
$totalPrice += $itemTotalPrice;
$totalDiscount += $itemDiscount;
$totalCharge += $itemDelivery;
$grandprice = $totalPrice - $totalDiscount + $totalCharge;

        ?>
        <div class="cart-item">
            <img src="images/product/<?php echo $deta['ProductImage'];?>" alt="Product">
            <div class="item-details">
                <h3><?php echo $deta['ProductName'];?></h3>
                <p class="stock"><?php echo $deta['Availability'];?></p>

                <p class="price">₹<?php echo $finalPrice * $countQty;?>  <span style="font-size:12px;text-decoration: line-through; color:#fb7474 ;padding-left:10px">₹<?php echo $price * $countQty;?></span></p>
                <p class="qty">
                    <select name="qty" id="qty">
                        <option value="1">Qty : <?php echo $deta['Count'];?></option>
                    </select>
                </p>
                <div class="actions">
                    <form action="customer_cart_action.php" method="post">
                        <input type="hidden" name="cart" value="<?php echo $deta['Id'];?>">
                    <a href="#"><button>Save for Later</button></a>
                    <input type="button" value="Remove" name="btn" class="btn">
                    </form>
                </div>
            </div>
        </div>
<?php }?>
        
    </section>
   
    <!-- RIGHT SIDE PRICE DETAILS -->
     <div>
    <aside class="price-box">
        <h3>PRICE DETAILS</h3>
        <div class="price-row">
            <span>Price (<?php echo $count;?> items)</span>
            <span>₹<?php echo $totalPrice; ?></span>
        </div>
        <div class="price-row">
            <span>Discount</span>
            <span>- ₹<?php echo $totalDiscount; ?></span>
        </div>
        <div class="price-row">
            <span>Delivery Charges</span>
            <span>₹<?php echo $totalCharge;?></span>
        </div>
        <hr>
        <div class="price-row total">
            <span>Total Amount</span>
             <span>₹<?php echo $grandprice;?></span>
            
        </div>
        <p class="save-msg">You will save ₹<?php echo $totalDiscount; ?> on this order</p>
    </aside>
    <div class="secure">
        <div class="col-6 img" style="
    width: -1% !important;">
    <img style="width:40px" src="images/Safe_and_secure.png" alt="">
    </div>
    <div class="safe">
    <p>Safe and Secure Payments.Easy returns.
        <br>100% Authentic products.</p>
        </div>
        </div>
        <a href="customerPayment.php"><button class="place-order">PLACE ORDER</button></a>
    </div>
 <?php       
            }
            else
            {
                ?>
                <section class="cart-items">
                    <p>No Items</p>
                </section>
                <?php }?>
</main>

</body>

</html>
