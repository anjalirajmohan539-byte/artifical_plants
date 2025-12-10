<?php

include('database.php');

$product_id = $_GET['productId'];

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/delivery_details.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

<div class="header">
    <p>ADDITIONAL DETAILS</p>
    <p style="margin-right: 90%;margin-top: -64px;font-size: 30px;"><a href="add_product.php">⟵</a></p>

</div>
<div class="container">

    <!---------------------------------------------------- LEFT: SIDE ---------------------------------------------------->
<div class="left">
    <!---------------------------------------------------- IMAGE ---------------------------------------------------->
    
<?php
$select = "SELECT ap.Id, ap.ProductImage, pi.Images, ProductName, Price, ColorName 
           FROM add_product ap
           INNER JOIN product_images pi ON pi.ProductId = ap.Id 
           WHERE ap.Id = $product_id AND pi.IsDelete = 0";

$statemnt = mysqli_query($conn,$select);

if(mysqli_num_rows($statemnt) > 0)
{
    $allImages = [];
    while($row = mysqli_fetch_assoc($statemnt)) {
        $allImages[] = $row;
    }

    $image = $allImages[0];
?>
    <img src="images/product/<?php echo $image['ProductImage']; ?>" class="main-img" id="mainImage">

    <div class="product-title"><?php echo $image['ProductName']; ?></div>

    <p><b>Price:</b> ₹<?php echo $image['Price']; ?></p>
    <p><b>Color:</b> <?php echo $image['ColorName']; ?></p>

<?php } ?>

</div>


    <!---------------------------------------------------- RIGHT: SIDE ---------------------------------------------------->
    <div class="right">

        <!---------------------------------------------------- Product Information ---------------------------------------------------->

        <div class="card">
            <div class="card-title">Shipping Details</div>
           <form action="#" method="post">

        <fieldset>
            <?php
            $select = "SELECT `Id`, `Name` FROM `product_availability` WHERE `IsDeleted` = 0";
            $statemnt = mysqli_query($conn, $select);

            if(mysqli_num_rows($statemnt) > 0)
            {
            
            ?>
            <label for="">Availability</label>
            <select name="available" id="available">
              <?php
              while($row = mysqli_fetch_assoc($statemnt))
              {

              ?>
                <option value="<?php echo $row['Id'];?>"><?php echo $row['Name'];?></option>
                <?php }?>
            </select>
            <?php }?>

            <?php
            $date = "2024-12-11";
            ?>
            <label for="">Delivery Days</label>
            <input type="text" class="dday" name="dday" value="<?php echo date("d M, l", strtotime($date));?>">

            <label for="">Delivery Charge</label>
            <select name="charge" id="charge">
              <option value="">Free Delivery</option>
              <option value="">With Delivery fee</option>
            </select>
        </fieldset>
        <button class="btn1">Add</button>
        
      </form>
        </div>

        <div class="card">
          <div class="card-title">Delivery Details</div>
           <form action="#" method="post">

        <fieldset>
            
            <label for="">Return</label>
            <input type="text" name="return" id="return">

          <div class="col-4 ondelivery">
            <label for="" class="Payment">Payment Method</label>
	         <input type="radio" id="ondelivery" value="" name="ondelivery" >
	        <h3 class="deliveryt">Cash on Delivery</h3>

	        <input type="radio" id="charge" value="" name="charge">
	        <h3 class="deliveryt">Delivery Charge</h3>
         </div>

         <div class="cl"></div>

            <label for="">Customer Support</label>
            <select name="customer" id="customer">
              <option value="">Yes</option>
              <option value="">No</option>
              <option value=""></option>
            </select>
        </fieldset>
        <button class="btn1">Add</button>
        
      </form>
        </div>

        <div class="card">
        <div class="card-title">Dimensions</div>
           <form action="#" method="post">

        <fieldset>
            
            <label for="">Width</label>
            <input type="text" name="Width" id="Width">
            <label for="">Height</label>
            <input type="text" name="Height" id="Height">
            <label for="">Weight</label>
            <input type="text" name="Weight" id="Weight">

        </fieldset>
        <button class="btn1">Add</button>
        
      </form>
      </div>
</div>
</body>
</html>