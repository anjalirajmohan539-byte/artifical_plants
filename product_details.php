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
   <div class="header">
  <h2>PRODUCT DETAILS</h2>
</div>

<div class="product-container">
  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="product-card">
      <img id="mainImg" src="images/plant_5.png" alt="Product Image">
      <h3 id="prodTitle">Artificial Plant</h3>
      <p class="name"><strong style="color:#666;">Product Name:</strong> Artificial Plant</p>
      <p class="color"><strong>Color:</strong> Dark Green</p>
      <div class="df">
        <span><img src="images/plant_3.png" alt=""></span>
        <span><img src="images/plant_3.png" alt=""></span>
        <span><img src="images/plant_3.png" alt=""></span>
        <span><img src="images/plant_3.png" alt=""></span>
      </div>
      <p class="member-since">Different Images</p>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <section class="plant">
      <h3>Plant Information</h3>
      <div class="info-grid">
        <div><strong>Product Name</strong><p id="infoName">Artificial Plant</p></div>
        <div><strong>Primary Material</strong><p id="infoMaterial">Plastic</p></div>
        <div><strong>Price</strong><p id="infoPrice">₹499</p></div>
        <div><strong>Color</strong><p id="infoColor">Dark Green</p></div>
        <div><strong>Incl. of All Tax</strong><p>Yes</p></div>       
        <div><strong>Is It With Vase</strong><p>Yes</p></div>
        <div><strong>Product Description</strong><p id="infoDesc">A beautiful artificial plant perfect for home decoration.</p></div>
      </div>
    </section>

    <div class="grid-section">
      <section class="experience">
        <h3>Shipping Information</h3>
        <ul>
          <li><span>Availability: In Stock</span></li>
          <li><span>Delivery by: 3-5 business days</span></li>
          <li><span>Free Delivery</span></li>
        </ul>
      </section>

      <section class="education">
        <h3>Pair Well With</h3>
        <ul>
          <li><img src="images/plant_5.png" alt="" style="width:80px;border-radius:6px;"></li>
          <li><span>Mini Vase</span></li>
          <li><span>₹299</span></li>
        </ul>
      </section>
    </div>
  </div>
</div>


<script>

const thumbnails = document.querySelectorAll('.df img');
const mainImg = document.getElementById('mainImg');

thumbnails.forEach(img => {
  img.addEventListener('click', () => {
    mainImg.src = img.src;
  });
});


const productData = {
  name: "Artificial Plant",
  material: "Plastic",
  price: "₹499",
  color: "Dark Green",
  desc: "Beautiful artificial plant ideal for living rooms and offices."
};

document.getElementById("infoName").textContent = productData.name;
document.getElementById("infoMaterial").textContent = productData.material;
document.getElementById("infoPrice").textContent = productData.price;
document.getElementById("infoColor").textContent = productData.color;
document.getElementById("infoDesc").textContent = productData.desc;
</script>
</body>
</html>