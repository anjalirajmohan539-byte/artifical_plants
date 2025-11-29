<?php

include('database.php');

$product_id = $_GET['productId'];

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_details.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div class="header">PRODUCT DETAILS</div>

<div class="container">

    <!---------------------------------------------------- LEFT: SIDE ---------------------------------------------------->
    <div class="left">
        <?php
        $select = "";
        ?>

    
        <img src="images/plant_3.png" class="main-img" id="mainImage">

        <div class="product-title">Artificial Plant</div>

        <p><b>Price:</b> ₹499</p>
        <p><b>Color:</b> Dark Green</p>

        <div class="thumbs">
            <img src="images/plant_1.jpg" onclick="swap(this)">
            <img src="images/plant_2.jpg" onclick="swap(this)">
            <img src="images/plant_4.png" onclick="swap(this)">
            <img src="images/plant_5.png" onclick="swap(this)">
        </div>
    </div>

    <!---------------------------------------------------- RIGHT: SIDE ---------------------------------------------------->
    <div class="right">

        <!---------------------------------------------------- Product Information ---------------------------------------------------->
        <div class="card">
            <div class="card-title">Product Information</div>


            <div class="grid">
                <div class="info"><div class="label">Product Name</div><div class="value">Artificial Plant</div></div>
                <div class="info"><div class="label">Primary Material</div><div class="value">Plastic</div></div>
                <div class="info"><div class="label">Price</div><div class="value">₹499</div></div>
                <div class="info"><div class="label">Color</div><div class="value">Dark Green</div></div>
                <div class="info"><div class="label">Tax Included</div><div class="value">Yes</div></div>
                <div class="info"><div class="label">With Vase</div><div class="value">Yes</div></div>
            </div>
        </div>

        <!---------------------------------------------------- Shipping Info ---------------------------------------------------->
        <div class="card">
            <div class="card-title">Shipping Details</div>
            <ul class="shipping">
                <li>Availability: In Stock</li>
                <li>Delivery within: 3–5 days</li>
                <li>Free Delivery</li>
            </ul>
        </div>

        <!---------------------------------------------------- Pair Well With ---------------------------------------------------->
        <div class="card">
            <div class="card-title">Pair Well With</div>
            <div class="pair">
                <img src="images/vase1.jpg">
                <div>
                    <div style="font-size:17px;font-weight:600;color:#1d3557;">Mini Vase</div>
                    <div style="color:#333;">₹299</div>
                </div>
            </div>
        </div>


        <!---------------------------------------------------- Delivery Details ---------------------------------------------------->
                <div class="card">
            <div class="card-title">Delivery Details</div>
            <div class="delivery col-4">
              <li><a href="">7-Day Return ></a></li>
            </div>
            <div class="delivery col-4">
              <li><a href="">Cash on Delivery ></a></li>
            </div>
            <div class="delivery col-4">
              <li><a href="">Customer Support ></a></li>
            </div>
        </div>

    </div>
</div>

<script>
function swap(img){
    document.getElementById("mainImage").src = img.src;
}
</script>
</body>
</html>