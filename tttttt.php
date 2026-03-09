<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Botani Plants</title>
</head>
<style>
  *{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#000;
color:#fff;
}

/* Navbar */

.nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 60px;
}

.menu{
display:flex;
list-style:none;
gap:30px;
}

/* Hero */

.hero{
height:80vh;
background:url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') center/cover;
display:flex;
align-items:center;
padding-left:80px;
}

.hero h1{
font-size:50px;
margin-bottom:10px;
}

.hero button{
padding:10px 25px;
border:none;
background:#4CAF50;
color:white;
cursor:pointer;
}

/* Choose section */

.choose{
text-align:center;
padding:80px 20px;
}

.choose-img img{
width:80%;
margin-top:40px;
}

/* Nature section */

.nature{
display:flex;
justify-content:space-between;
padding:80px;
gap:40px;
}

.nature-gallery{
display:grid;
grid-template-columns:repeat(2,150px);
gap:20px;
}

.nature-gallery img{
width:100%;
border-radius:10px;
}

/* Products */

.products{
padding:80px;
text-align:center;
}

.product-grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:30px;
margin-top:40px;
}

.card{
background:#111;
padding:20px;
border-radius:10px;
}

.card img{
width:100%;
height:200px;
object-fit:cover;
}

/* Banner */

.banner{
height:350px;
background:url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') center/cover;
display:flex;
align-items:center;
padding-left:80px;
margin-top:80px;
}

.banner button{
margin-top:10px;
padding:10px 20px;
border:none;
background:#4CAF50;
color:white;
}

/* Footer */

footer{
text-align:center;
padding:20px;
background:#111;
margin-top:40px;
}
</style>
<body>

<!-- Navbar -->
<header>
<div class="nav">
<h2 class="logo">BOTANI</h2>

<ul class="menu">
<li>Home</li>
<li>Shop</li>
<li>Products</li>
<li>Blog</li>
<li>Pages</li>
</ul>
</div>
</header>

<!-- Hero Section -->
<section class="hero">
<div class="hero-content">
<h1>Nature at Your Fingertips</h1>
<p>Bring greenery to your home with our beautiful plants.</p>
<button>Shop Now</button>
</div>
</section>

<!-- Choose Plants -->
<section class="choose">
<h2>Choose Your Plants</h2>

<div class="choose-img">
<img src="https://images.unsplash.com/photo-1582582429416-3f0b64d2a24b">
</div>

</section>

<!-- Nature Section -->
<section class="nature">

<div class="nature-text">
<h2>Nature at Your Fingertips</h2>
<p>
Transform your space with the beauty of plants. Our carefully
selected indoor plants bring calmness and freshness into your life.
</p>
</div>

<div class="nature-gallery">

<img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6">
<img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735">
<img src="https://images.unsplash.com/photo-1461354464878-ad92f492a5a0">
<img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7">

</div>

</section>

<!-- Product Grid -->
<section class="products">

<h2>Our Plants</h2>

<div class="product-grid">

<div class="card">
<img src="https://images.unsplash.com/photo-1509423350716-97f9360b4e09">
<h4>Lipstick Plant</h4>
<p>$300</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1593691509543-c55fb32a6b32">
<h4>ZZ Plant</h4>
<p>$280</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6">
<h4>Dracaena</h4>
<p>$200</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411">
<h4>Snapdragon</h4>
<p>$350</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1446071103084-c257b5f70672">
<h4>Orchid</h4>
<p>$500</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1509423350716-97f9360b4e09">
<h4>Philodendron</h4>
<p>$420</p>
</div>

</div>

</section>

<!-- Promo Banner -->

<section class="banner">

<div class="banner-content">
<h2>Nature at Your Fingertips</h2>
<p>Bring greenery and freshness to your home.</p>
<button>All Products</button>
</div>

</section>

<!-- Footer -->

<footer>

<p>© 2025 Botani Plant Store</p>

</footer>

</body>
</html>






