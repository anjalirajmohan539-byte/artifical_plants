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
         $details = "SELECT ap.`Id`, `ProductImage`, `ProductName`, `Description`,ap.`Price`, off.DiscountValue, sd.`Deliverycharge`, 
                    `ColorName`, `ColorCode`, `CategoryId`, `CategoryTypeId`, `MaterialId`, `MaterialTypeId`, `ProductCount`,pa.Name AS `Availability` FROM `add_product` ap
                    INNER JOIN cart ca ON ca.ProductId = ap.Id
                    INNER JOIN product_availability pa ON pa.Id = ap.Availability
                    INNER JOIN product_offers pf ON pf.ProductId = ap.Id
                    INNER JOIN offers off ON off.Id = pf.OfferId
                    INNER JOIN shipping_details sd ON sd.ProductId = ap.Id
                    WHERE ap.`IsDeleted` = 0 AND ca.CustomerId = $Id";
                    var_dump($details);

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
                        $discountType = $deta['DiscountType'] ?? null;
                        $discountValue = $deta['DiscountValue'] ?? 0;
                        $deliverCharge = $deta['Deliverycharge'] ?? 0;

                if ($discountType == "Percentage") {
                    $discountAmount = ($price * $discountValue) / 100;
                    } else {
                        $discountAmount = $discountValue;
                    }

                        $finalPrice = $price - $discountAmount;
                if ($finalPrice < 0) {
                        $finalPrice = 0;
                    }
                

// 👉 ADD THIS
$totalPrice += $price;
$totalDiscount += $discountAmount;
$totalCharge += $deliverCharge;
                      
$grandTotal = $totalPrice - $totalDiscount;
$delivery = $grandTotal + $totalCharge;
        ?>
        <div class="cart-item">
            <img src="images/product/<?php echo $deta['ProductImage'];?>" alt="Product">
            <div class="item-details">
                <h3><?php echo $deta['ProductName'];?></h3>
                <p class="stock"><?php echo $deta['Availability'];?></p>
                 <?php //$grandTotal = $totalPrice - $totalDiscount; ?>
                <p class="price"><?php echo $grandTotal;?>/-  <span style="font-size:12px;text-decoration: line-through;color:red;padding-left:10px"><?php echo $price;?></span></p>
                <p class="qty">
                    <select name="qty" id="qty">
                        <option value="1">Qty : 1</option>
                        <option value="2">Qty : 2</option>
                        <option value="3">Qty : 3</option>
                        <option value="more">more</option>
                    </select>
                </p>
                <div class="actions">
                    <button>Save for Later</button>
                    <button>Remove</button>
                </div>
            </div>
        </div>

        
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
            <span>₹<?php echo $deta['Deliverycharge'];?></span>
        </div>
        <hr>
        <div class="price-row total">
            <span>Total Amount</span>
            <?php //$grandTotal = $totalPrice - $totalDiscount; ?>
             <span>₹<?php echo $delivery; ?></span>
            
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
    <?php       }
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
