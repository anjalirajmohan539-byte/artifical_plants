<?php

include('database.php');
include('header.php');

?>



    <link rel="stylesheet" href="css/customer_cart.css">

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
     <?php
         $details = "SELECT ap.`Id`, `ProductImage`, `ProductName`, `Description`, `Price`, `ColorName`, `ColorCode`, `CategoryId`, `CategoryTypeId`, `MaterialId`, `MaterialTypeId`, `ProductCount` FROM `add_product` ap
                    INNER JOIN cart ca ON ca.ProductId = ap.Id
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
                         $price = $deta['Price']; // default price
             $discountType = $deta['DiscountType'] ?? null;
             $discountValue = $deta['DiscountValue'] ?? 0;
        
              if ($discountType == "Percentage") {
                  $discountAmount = ($price * $discountValue) / 100;
                  } else { 
                    $discountAmount = $discountValue;
                    }
                    $finalPrice = $price - $discountAmount;
                    if ($finalPrice < 0) {
                      $finalPrice = 0;
                      }
        ?>
        <div class="cart-item">
            <img src="images/product/<?php echo $deta['ProductImage'];?>" alt="Product">
            <div class="item-details">
                <h3><?php echo $deta['ProductName'];?></h3>
                <p class="stock out">Out of Stock</p>
                <p class="price"><?php echo $deta['Price'];?>/-</p>
                <p class="qty">Qty</p>
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
            <span>₹<?php echo $deta['Price'];?></span>
        </div>
        <div class="price-row">
            <span>Discount</span>
            <span class="green">− ₹<?php echo $discountValue != 0 ? $discountAmount : "";?></span>
        </div>
        <div class="price-row">
            <span>Delivery Charges</span>
            <span>FREE</span>
        </div>
        <hr>
        <div class="price-row total">
            <span>Total Amount</span>
            <span>₹1,490</span>
        </div>
        <p class="save-msg">You will save ₹812 on this order</p>
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
