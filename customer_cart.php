<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/customer_cart.css">
</head>
<body>

<header class="topbar">
    <div class="logo">MILON<br><b>Artifical Flowers and Home Decors</b></div>
    <input type="text" placeholder="Search for products and more">
    <div class="user">user ▾</div>
</header>

<main class="container">
    <!-- LEFT SIDE CART ITEMS -->
    <section class="cart-items">
        <div class="delivery">
            Deliver to: <strong>Anjali Rajmohan, 680652</strong>
            <button class="change-btn">Change</button>
        </div>

        <!-- Item -->
        <div class="cart-item">
            <img src="https://via.placeholder.com/100" alt="Product">
            <div class="item-details">
                <h3>Ceramic Coffee Mug Set (Pack of 6)</h3>
                <p class="stock out">Out of Stock</p>
                <div class="actions">
                    <button>Save for Later</button>
                    <button>Remove</button>
                </div>
            </div>
        </div>

        <div class="cart-item">
            <img src="https://via.placeholder.com/100" alt="Product">
            <div class="item-details">
                <h3>Sports Stainless Steel Water Bottle</h3>
                <p class="stock">In Stock</p>
                <div class="actions">
                    <button>Save for Later</button>
                    <button>Remove</button>
                </div>
            </div>
        </div>

        <button class="place-order">PLACE ORDER</button>
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
    </div>
</main>

</body>
</html>
