<?php

include('database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/customer_cart.css">
</head>
<body>

    <header>
<div class="nav">
    <div>
<h2 class="logo">MILON</h2>
<p class="text-body-secondary" style="color:white;">Artifical Flowers and Home Decors</p>
</div>
<input type="text" placeholder="Search for products and more">
<ul class="menu">
<li>Home</li>
<li>Products</li>
<li>Orders</li>
<li>Blog</li>
<li>User</li>
</ul>
</div>
</header>

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
    <section class="cart-items">
        <div class="delivery">
            Deliver to: <strong>Hana, 680652</strong>
           <a href="shipping_customer_details.php"><button class="change-btn">Change</button></a> 
        </div>

        <!-- Item -->
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
    <div class="col-6 safe">
    <p>Safe and Secure Payments.Easy returns.
        <br>100% Authentic products.</p>
        </div>
        </div>
        <button class="place-order">PLACE ORDER</button>
    </div>
    
</main>

</body>
</html>
