<?php

include('database.php');
include('header.php');

?>



    <link rel="stylesheet" href="css/customer_cart.css">

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
    <section class="cart-items">
        <?php

        $select = "SELECT `Customer_Id`, `Name`, `Pincode` FROM `delivery_customer_details` WHERE `status` = 0 AND IsDelected = 0 ";
        $check = mysqli_query($conn,$select);

        if(mysqli_num_rows($check)>0)
            {
                $cus = mysqli_fetch_assoc($check);
            
        ?>
        <div class="delivery">
            Deliver to: <strong><?php echo $cus['Name'];?>, <?php echo $cus['Pincode'];?></strong>
           <a href="shipping_customer_details.php?customerId=<?php echo $id;?>"><button class="change-btn">Change</button></a> 
        </div>
<?php }?>
        <!-- Item -->

        <?php
        $details = "SELECT ap.`Id`, `ProductImage`, `ProductName`, `Description`, `Price`, `ColorName`, `ColorCode`, `CategoryId`, `CategoryTypeId`, `MaterialId`, `MaterialTypeId`, `ProductCount` FROM `add_product` ap
                    INNER JOIN cart ca ON ca.ProductId = ap.Id
                    WHERE ap.`IsDeleted` = 0 AND ca.Id = $id";

        $check2 = mysqli_query($conn,$details);
        ?>
        <div class="cart-item">
            <img src="images/bud_vase.jpg" alt="Product">
            <div class="item-details">
                <h3>Ceramic Coffee Mug Set (Pack of 6)</h3>
                <p class="stock out">Out of Stock</p>
                <p class="price">299/-</p>
                <p class="qty">Qty</p>
                <div class="actions">
                    <button>Save for Later</button>
                    <button>Remove</button>
                </div>
            </div>
        </div>

        <div class="cart-item">
            <img src="images/Ceramic_Floral_Vase.jpg" alt="Product">
            <div class="item-details">
                <h3>Sports Stainless Steel Water Bottle</h3>
                <p class="stock">In Stock</p>
                <p class="price">299/-</p>
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
            <span>Price (2 items)</span>
            <span>₹2,302</span>
        </div>
        <div class="price-row">
            <span>Discount</span>
            <span class="green">− ₹812</span>
        </div>
        <div class="price-row">
            <span>Delivery Charges</span>
            <span class="green">FREE</span>
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
    
</main>

</body>

</html>
