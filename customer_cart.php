<?php

include('database.php');
include('header.php');

$totalPrice = 0;
$totalDiscount = 0;
$totalCharge = 0;



if(isset($_POST['remove']) && $_SERVER["REQUEST_METHOD"] == "POST")
    {
        $customerId = $_POST['customerId'];
        $rowId = $_POST['rowId'];

        $removeUpdate = "UPDATE `cart` SET `Status`= 1 WHERE `CustomerId`= $customerId AND Id = $rowId";
        // var_dump($removeUpdate);
        $checkupdate = mysqli_query($conn,$removeUpdate);
        if($checkupdate)
            {
                echo "<script>window.location.href='customer_cart.php'</script>";
            }
            else
                {
                    echo "error";
                }
    }

?>



    <link rel="stylesheet" href="css/customer_cart.css">

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
     <?php
         $details = "SELECT ap.`Id` AS ProductId, wl.Id AS wishlistId, ca.Id AS cartId, `ProductImage`, `ProductName`, `Description`,ap.`Price`, off.DiscountValue, sd.`Deliverycharge`, off.`DiscountType`,ca.Count, 
                    `ColorName`, `ColorCode`, `CategoryId`, `CategoryTypeId`, `MaterialId`, `MaterialTypeId`, `ProductCount`,pa.Name AS `Availability` FROM `add_product` ap
                    LEFT JOIN cart ca ON ca.ProductId = ap.Id
                    LEFT JOIN wishlist wl ON wl.ProductId = ap.Id
                    LEFT JOIN product_availability pa ON pa.Id = ap.Availability
                    LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
                    LEFT JOIN offers off ON off.Id = pf.OfferId
                    LEFT JOIN shipping_details sd ON sd.ProductId = ap.Id
                    WHERE ca.`Status` = 0 AND ca.CustomerId = $Id";
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
$wishlsitId = $deta['wishlistId'];
$ProductId = $deta['ProductId'];
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
$finalTotalPrice = $finalPrice * $countQty;

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

                <p class="price">
    ₹<?php echo $finalTotalPrice; ?>

    <?php if(($finalTotalPrice) != $itemTotalPrice){ ?>
        <span style="font-size:12px;text-decoration: line-through; color:#fb7474; padding-left:10px">
            ₹<?php echo $itemTotalPrice; ?>
        </span>
    <?php } ?>
</p>
                <p class="qty">
                    <select name="qty" id="qty">
                        <option value="1">Qty : <?php echo $deta['Count'];?></option>
                    </select>
                </p>
                <div class="actions">
                    <form action="customer_cart.php" method="post">
                    <a href="wishlist_action.php?pId=<?php echo $deta['ProductId']?>&customer=<?php echo $Id?>&rId=<?php echo $deta['wishlistId']?>"><button class="btn1" <?php if($deta['wishlistId'] != 0){echo "disabled";}?>><?php echo $deta['wishlistId'] ? "Item in Wishlist" : "Save for Later";?></button></a>
                    <input type="hidden" name="customerId" id="customerId" value="<?php echo $Id;?>">
                    <input type="hidden" name="rowId" id="rowId" value="<?php echo $deta['cartId'];?>">
                    <button class="btn2" type="submit" name="remove" id="remove" onclick="return confirm('Are you sure to remove this product ?')">Remove</button>
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
