<?php

include('database.php');

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_index</title>
<link href="css/header.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid---bs-gutter-x:none;">
    <div class="header">
        <div class="col-3 search">
            <div class="input-container">
    <input type="text" name="text" class="input" placeholder="Search something...">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
    </div>
        </div>
        <div class="col-3">
            <h1 class="text-light">MILON</h1>
            <p class="text-body-secondary">Artifical Flowers and Home Decors</p>
        </div>
        <div class="col-3">
            <a href="login.php"><img src="images/contact.png"></a>
            <a href="customer_cart.php"><img src="images/shopping-cart.png"></a>
            <a href="#"><img src="images/wishlist.png"></a>
        </div>
    </div>
    <div class="menu">
        <a href="#" class="text-light">HOME</a>
        <a href="#" class="text-light">NEW ARRIVALS</a>
        <a href="#" class="text-light">DECOR</a>
        <a href="#" class="text-light">ARTIFICAL FLOWERS</a>
        <div id="vase" class="vase">
        <a href="vase.php" class="dropbtn text-light">VASE ▾</a>
      
        <div class="menu_dropdown">
              <?php
        $select = "SELECT `Id`, `Image`, `Name`, `CategoryId` FROM `category_type` WHERE  `IsDeleted` = 0";
        $statemnt = mysqli_query($conn,$select);

        if(mysqli_num_rows($statemnt)>0)
      {
        while($row = mysqli_fetch_assoc($statemnt))
          {
            $id = $row['Id'];
            $name = $row['Name'];
            $img=$row['Image'];    
        
        ?>
            <a href="#" class="vaseFilter" data-type="<?php echo $id;?>"><img src="images/<?php echo $img;?>" alt="" data-name="<?php echo $name;?>"><?php echo $name;?></a>

                 <?php
        }
      }
    ?>
        </div>
     
        </div>
        <a href="#" class="text-light">PEBBLES & MOSS</a>
        <a href="#" class="text-light">BLOG</a>
    </div>
    </div>