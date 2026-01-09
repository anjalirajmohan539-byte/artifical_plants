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
</head>

<body>
<div class="header">
    <p>PRODUCT DETAILS</p>
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
        //    var_dump($select);

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

    <div class="thumbs">
        <?php
        foreach($allImages as $img) {
        ?>
            <img src="images/product/<?php echo $img['Images']; ?>" onclick="swap(this)">
            <?php } ?>
            <img src="images/product/<?php echo $image['ProductImage']; ?>" onclick="swap(this)">
    </div>

<?php } ?>

<br>

<?php
$select = mysqli_query($conn, "SELECT * FROM product_dimensions WHERE ProductId = $product_id");
$data = mysqli_fetch_assoc($select);
?>

<div class="card-title" style="display: flex;justify-content: space-between">Dimensions Details<sv><a href="delivery_details.php?productId=<?php echo $product_id;?>&sectionId=Width" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></sv></div>

  <div class="dimension-row" id="dimension">
    <li><span>Width : </span><span><?php echo $data['Width']; ?></span></li>
  </div>

  <div class="dimension-row">
    <li><span>Height : </span><span><?php echo $data['Height']; ?></span></li>
    
  </div>

  <div class="dimension-row">
    <li><span>Weight : </span><span><?php echo $data['Weight']; ?></span></li>
    
  </div>
</div>




    <!---------------------------------------------------- RIGHT: SIDE ---------------------------------------------------->
    <div class="right">

        <!---------------------------------------------------- Product Information ---------------------------------------------------->

        <div class="card">
            <div class="card-title" style="display: flex;justify-content: space-between">Product Information<sk><a href="add_product.php?productid=<?php echo $product_id;?>" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></sk></div>
            <?php
            $productSelect = "SELECT ap.`Id`, `ProductName`, `Price`, `ColorName`, mt.Name AS `MaterialId` FROM `add_product` ap
                              INNER JOIN material_type mt ON mt.Id = ap.MaterialId WHERE ap.Id = $product_id ";
            $product_statment = mysqli_query($conn,$productSelect);
            // var_dump($productSelect);

            if(mysqli_num_rows( $product_statment)> 0)
            {
                $product = mysqli_fetch_assoc($product_statment);
            
            ?>

            <div class="grid">
                <div class="info"><div class="label">Product Name</div><div class="value"><?php echo $product['ProductName'];?></div></div>
                <div class="info"><div class="label">Primary Material</div><div class="value"><?php echo $product['MaterialId'];?></div></div>
                <div class="info"><div class="label">Price</div><div class="value">₹<?php echo $product['Price'];?></div></div>
                <div class="info"><div class="label">Color</div><div class="value"><?php echo $product['ColorName'];?></div></div>
                <div class="info"><div class="label">Tax Included</div><div class="value">Yes</div></div>
                <div class="info"><div class="label">With Vase</div><div class="value">Yes</div></div>
            </div>
            <?php }?>
        </div>

        <!---------------------------------------------------- Shipping Info ---------------------------------------------------->

        <div class="card">
            <div class="card-title" style="display: flex;justify-content: space-between">Shipping Details <s><a href="delivery_details.php?productId=<?php echo $product_id;?>&sectionId=available" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></s></div>
            <ul class="shipping">
                <li>Availability: In Stock</li>

                <!------- Delivery Days ------->

                <?php
                $sql = "SELECT `DeliveryDays` FROM `shipping_details` WHERE productId = $product_id";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                
                $days = $row['DeliveryDays'] ?? 4;
                $date = date_create();
                date_add($date, date_interval_create_from_date_string($days . " days"));
                ?>

                <li>Delivery by <?php echo date_format($date,"d M, D");?></li>

                <!------- Count Days ------->
        
                <p id="deliveryCountdown">
                    
                Order within <strong><?php echo $days;?> days</strong> for fastest delivery
            </p>

                <?php
                    $sql = "SELECT DeliveryType, DeliveryCharge FROM shipping_details WHERE productId = $product_id";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);

                    $deliveryType   = $row['DeliveryType'] ?? 1;
                    $deliveryCharge = $row['DeliveryCharge'] ?? 0;
                ?>

                <li><?php if ($deliveryType == 1) {echo "Free Delivery";} else {echo "Delivery Fee: ₹" . number_format($deliveryCharge, 2);}?></li>

            </ul>
        </div>




        


        <!---------------------------------------------------- Payment Method ---------------------------------------------------->


        <div class="card">
            <div class="card-title" style="display: flex;justify-content: space-between">Payment Method<s><a href="delivery_details.php?productId=<?php echo $product_id;?>&sectionId=ondelivery" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></s></div>

<!------- Return Days ------->

<?php
$pay = "SELECT pm.name AS`PaymentMethodId` FROM `payment_product_method`ppm 
        INNER JOIN `payment_method`pm ON pm.Id = ppm.PaymentMethodId
        WHERE ProductId = $product_id";

$res = mysqli_query($conn, $pay);

if(mysqli_num_rows($res)>0)
{
    while($pays = mysqli_fetch_assoc($res))
    {

 

?>
            <div class="delivery col-4">
            <li><a href=""><?php echo $pays['PaymentMethodId']; ?></a></li>
            </div>
            <?php    }
}?>
        </div>






                <!---------------------------------------------------- Delivery Details ---------------------------------------------------->

        <div class="card">
            <div class="card-title" style="display: flex;justify-content: space-between">Delivery Details<s><a href="delivery_details.php?productId=<?php echo $product_id;?>&sectionId=returnId" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></s></div>

<!------- Return Days ------->

<?php
$sql = "SELECT s.DeliveryDays, r.ReturnDays FROM shipping_details s
        JOIN return_details r ON s.productId = r.productId
        WHERE s.productId = $product_id";

$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$deliveryDays = $row['DeliveryDays'] ?? 4;
$returnDays   = $row['ReturnDays'] ?? 7;

$returnDate = date_create();
date_add($returnDate, date_interval_create_from_date_string(($deliveryDays + $returnDays) . " days"));

?>
            <div class="delivery col-4">
            <li><a href="">Return within <?php echo $returnDays; ?> days</a></li>
            </div>
        </div>



    


        <!---------------------------------------------------- Pair Well With ---------------------------------------------------->

        <div class="card">
            <div class="card-title" style="display: flex;justify-content: space-between;">Pair Well With <s><a href="product_pair.php?productId=<?php echo $product_id;?>" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a></s></div>
            <div class="pair">
                           <?php
            
            $pair = "SELECT `Image`, `Name`, `Price` FROM `product_pair` WHERE `ProductId` = $product_id AND `IsDeleted` = 0";
            $check = mysqli_query($conn,$pair);

            if(mysqli_num_rows($check)>0)
            {
                while($pairs = mysqli_fetch_assoc($check))
                {
                    
             
            ?>
                <img src="images/pair/<?php echo $pairs['Image'];?>">
                <div>
                    <div style="font-size:17px;font-weight:600;color:#1d3557;"><?php echo $pairs['Name'];?></div>
                    <div style="color:#333;">₹<?php echo $pairs['Price'];?></div>
                </div>
                <?php    }
            }?>
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