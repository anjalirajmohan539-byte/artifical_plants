<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
  margin: 0;
  font-family: Arial, sans-serif;
}

.navbar {
  background-color: #333;
  padding: 10px;
}

.dropbtn {
  background-color: #333;
  color: white;
  padding: 10px 15px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 10px 12px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #555;
}

.show {
  display: block;
}

    </style>
</head>
<body>
 <div class="navbar">
  <div class="dropdown">
    <button class="dropbtn">Menu ▾</button>
    <div class="dropdown-content">
      <a href="#">Home</a>
      <a href="#">Products</a>
      <a href="#">Services</a>
      <a href="#">Contact</a>
    </div>
  </div>
</div>   
</body>
<script>
    <script>
document.querySelector(".dropbtn").addEventListener("click", function () {
  document.querySelector(".dropdown-content").classList.toggle("show");
});
</script>

</script>
</html>


