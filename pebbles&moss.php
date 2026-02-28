<?php
include('database.php');
include('header.php');
?>




  <!--   banner   -->
<link href="css/vase.css" rel="stylesheet">
  <div class="product-head">
      <h1 id="mainName">VASES</h1>
      <p id="mainDec">Bring the outdoors inside with our Pebbles & Moss, perfectly blending nature’s beauty with home décor.</p>
    </div>

  <!-- Main Section -->
  <div class="main_content">

  <!-- Products -->
  <div class="products row" id="productContainer">

      <div class="col-3 product-card">
        <a href="product_details.php?productId"><img src="images/product/" alt="">

        <input type="hidden" class="pid" value="">

        <h3></h3>

        <p>
          <span>₹</span> <span1 style="font-size:12px;text-decoration: line-through;color:red">₹</span1>
        </p>

        <p>
          Delivery by 
        </p>
        </a>
      </div>

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
<script src="js/jquery.min.js"></script>
<script>
$(document).on("click", ".vaseFilter", function(e){
    e.preventDefault();

    var vaseType = $(this).data("type");
    var vaseName = $(this).data("name");
    var vaseDec = $(this).data("dec");

    $.ajax({
        url: "filter_vase.php",
        type: "POST",
        data: { type: vaseType },
        success: function(response){
            $("#productContainer").html(response);

            if(vaseName){
                $("#mainName").text(vaseName);
            }
            if(vaseDec){
              $("#mainDec").text(vaseDec);
            }
        }
    });
});
</script>
</html>