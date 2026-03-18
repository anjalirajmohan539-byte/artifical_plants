<?php
include('database.php');
include('header.php');

$categoryTypeId = 0;

if(isset($_GET['categoryId']))
  {
  $categoryId = $_GET['categoryId'];
  }

  if(isset($_GET['categoryTypeId']))
    {
      $categoryTypeId = $_GET['categoryTypeId'];
    }

?>

<link href="css/vase.css" rel="stylesheet">

<nav class="navbar navbar-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search" oninput="loaddata()">
  </form>
</nav>

  <!--   banner   -->

  <div class="product-head">
    <?php

    if(isset($_GET['categoryTypeId']))
      {
        $select = "SELECT `Name`, `Description` FROM `category_type` WHERE Id = $categoryTypeId";
        $check = mysqli_query($conn,$select);

        if(mysqli_num_rows($check)>0)
          {
            $typeId = mysqli_fetch_assoc($check);
            echo '<h1 id="mainName">'.$typeId['Name'].'</h1>';
            echo '<p id="mainDec">'.$typeId["Description"].'</p>';
          }
      }
      else
        {

        
    switch($categoryId)
    {
      case 1 : 
        echo '<h1 id="mainName">Plants & Planters</h1>';
        echo '<p id="mainDec">When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>';
        break;
      case 2 :
        echo '<h1 id="mainName">VASES</h1>';
        echo '<p id="mainDec">When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>';
        break;
      case 3 :
        echo '<h1 id="mainName">Decors</h1>';
        echo '<p id="mainDec">When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>';
        break;
      case 4 :
        echo '<h1 id="mainName">Artifical Flowers</h1>';
        echo '<p id="mainDec">When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>';
        break;
      case 6 :
        echo '<h1 id="mainName">Pebbles & Moss</h1>';
        echo '<p id="mainDec">When it comes to displaying your Milon vases at home, some vases are better suited for one type of flower over another.</p>';
        break;
      default : echo "Product";
      break;
    }
    }
    ?>
    </div>

    
  <!-- Main Section -->
  <div class="main_content">

  <!-- Products -->
  <div class="products row" id="productContainer">

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
        $(document).ready(function() {
            loaddata();
});
            function loaddata() {
              var search = document.getElementById('search').value;
              var categoryId = <?php echo $categoryId;?>;
              var categoryType = <?php echo $categoryTypeId;?>;

              alert(categoryType);
                $.ajax({
                    url: "filter_searchBar.php",
                    type: "GET",
                    data: {
                        search : search,
                        category : categoryId,
                        categoryTypeId : categoryType
                    },
                    success: function(data) {
                      console.log(data);
                        let response = JSON.parse(data);
                        $('#productContainer').html(response.books_html);
                    }
                });
            }
        
</script>

</html>