<?php

include('database.php');

$product_id = $_GET['productId'];

$deliveryType = 1;

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
           <form action="Shipping _Details_action.php" method="post">

        <fieldset>

 <!------- Availability ------->

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

<!------- Delivery Days ------->

            <?php
             if (isset($_POST['btn']))
            {
             $days = $_POST['delivery_days'];
             mysqli_query($conn, "UPDATE `shipping_details` SET `DeliveryDays`=$days WHERE Id = $product");
            }
            ?>

            <label for="">Delivery Days</label>
            <input type="text" class="form-control" name="dday">

<!------- Delivery Type ------->

            <label for="">Delivery Type</label>
            <select name="type" id="charge" onchange="showDeliveryCharge()">
              <option value="1"<?php echo ($deliveryType == 1) ? "selected" : ""; ?>>Free Delivery</option>
              <option value="2"<?php echo ($deliveryType == 2) ? "selected" : ""; ?>>With Delivery fee</option>
            </select>
            <input type="text" id="deliveryCharge" name="deliveryCharge" min="0" placeholder="Enter Delivery Charge">

            <input type="hidden" name="proId" id="proId" value="<?php echo $product_id;?>">
        </fieldset>
        <button class="btn1" name="btn">Add</button>

      </form>
        </div>

        <div class="card">
          <div class="card-title">Delivery Details</div>
           <form action="#" method="post">

        <fieldset>
            
<!------- Return ------->

            <label for="">Return</label>
            <input type="text" name="return" id="return">

<!------- Payment Method ------->

            <label for="" class="Payment">Payment Method</label><br>

          <div class="col-4 ondelivery"> 
	         <input type="radio" id="ondelivery" value="" name="ondelivery" >
	        <h3 class="deliveryt">Cash on Delivery</h3>

	        <input type="radio" id="ondelivery" value="" name="ondelivery">
	        <h3 class="deliveryt">UPI</h3>

	        <input type="radio" id="ondelivery" value="" name="ondelivery">
	        <h3 class="deliveryt">Credit/Debit Card</h3>
         </div>

         <div class="cl"></div>

<!------- Customer Support ------->

            <label for="" style="margin-bottom: 8px;">Customer Support</label>
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
<script>
  showDeliveryCharge();
function showDeliveryCharge()
{
 
  let deliveryType = document.getElementById('charge');
  let charge = document.getElementById('deliveryCharge');

  if(deliveryType.value == 1)
  {
    charge.value = "";
    charge.style.display = "none"; 
  }

  else
  {
    charge.value = "";
    charge.style.display = "block";
    charge.focus = "";
  }

}
</script>
</html>