<?php
include('database.php');
include('header.php');
?>




  <!--   banner   -->
<link href="css/vase.css" rel="stylesheet">
  <div class="product-head">
      <h1>VASES</h1>
      <p>When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>
    </div>

  <!-- Main Section -->
  <div class="main_content">

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Vase Types</h2>
    <ul>
      <li><img src="images/bowl_vase.jpg"><a href="#">Bowl Vase</a></li>
      <li><img src="images/bud_vase.jpg"><a href="#">Bud Vase</a></li>
      <li><img src="images/cylinder_vase.jpg"><a href="#">Cylinder Vase</a></li>
      <li><img src="images/Ceramic_vase.jpg"><a href="#">Ceramic Vase</a></li>
      <li><img src="images/cube_vase.jpg"><a href="#">Cube Vase</a></li>
      <li><img src="images/pitcher_vase.jpg"><a href="#">Pitcher Vase</a></li>
      <li><img src="images/setting_icon.jpg"><a href="#">Settings</a></li>
      <li><img src="images/exit.jpg"><a href="#">Logout</a></li>
    </ul>
  </div>

  <!-- Products -->
  <div class="products row">

    <?php
    $select = "SELECT Id, ProductImage, ProductName, Price FROM add_product WHERE IsDeleted = 0 AND CategoryId = 2";

    $check = mysqli_query($conn, $select);

    if ($check && mysqli_num_rows($check) > 0) 
      {
      while ($vase = mysqli_fetch_assoc($check)) 
        {

      
        $sql = "SELECT DeliveryDays FROM shipping_details WHERE ProductId = {$vase['Id']}";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $days = $row['DeliveryDays'] ?? 4;

        $date = new DateTime();
        $date->modify("+$days days");
    ?>

      <div class="col-3 product-card">
        <a href="product_details.php?productId=<?php echo $vase['Id'];?>"><img src="images/product/<?php echo $vase['ProductImage']; ?>" alt="<?php echo $vase['ProductName']; ?>">

        <input type="hidden" class="pid" value="<?php echo $vase['Id']; ?>">

        <h3><?php echo $vase['ProductName']; ?></h3>

        <p>
          <span>₹<?php echo number_format($vase['Price']); ?></span>
        </p>

        <p>
          Delivery by <?php echo $date->format("d M, D"); ?>
        </p>
        </a>
      </div>

    <?php
      }
    }
    ?>

  </div>
</div>


  <div class="cl"></div>

  <div class="recently_views">

  <h2>Recently Viewed</h2>

  <div class="container decor">
          <div class="col-3 ">
            <img src="images/decor_1.jpg" alt="">
            <p1>Artifical plant</p1><br>
            <p2><span>₹9,999</span><s>MRP₹13,000</s></p2>
        </div>
        <div class="col-3">
            <img src="images/decor_2.jpg" alt="">
            <p1>Artifical plant</p1><br>
            <p2><span>₹9,999</span><s>MRP₹13,000</s></p2>
        </div>
        <div class="col-3">
            <img src="images/decor_3.jpg" alt="">
            <p1>Artifical plant</p1><br>
            <p2><span>₹9,999</span><s>MRP₹13,000</s></p2>
        </div>
        <div class="col-3">
            <img src="images/decor_4.jpg" alt="">
            <p1>Artifical plant</p1><br>
            <p2><span>₹9,999</span><s>MRP₹13,000</s></p2>
        </div>
        <div class="cl"></div>
  </div>

  <!--   footer   -->

<?php

include('footer.php');

?>
</body>
</html>