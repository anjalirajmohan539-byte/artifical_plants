<?php
include('header.php');
include('database.php');

$totalPrice = 0;
$totalDiscount = 0;
$totalCharge = 0;

?>

<link href="css/wishlist.css" rel="stylesheet">


<div class="container wishlist">
    <?php
    $select = "SELECT ap.`Id`, `ProductImage`, `ProductName`,ap.`Price`, off.DiscountValue, pc.Categorys AS `CategoryId`,
                     `ProductCount`,pa.Name AS `Availability` FROM `add_product` ap
                    INNER JOIN product_category pc ON pc.Id = ap.CategoryId
                    INNER JOIN wishlist wl ON wl.ProductId = ap.Id
                    INNER JOIN product_availability pa ON pa.Id = ap.Availability
                    LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
                    LEFT JOIN offers off ON off.Id = pf.OfferId
                    WHERE ap.`IsDeleted` = 0 AND wl.CustomerId = $Id AND wl.Favorite = 1";

$check = mysqli_query($conn,$select);
$count = mysqli_num_rows($check);
if(mysqli_num_rows($check)>0)
  {
    ?>
    <h2>WISHLIST</h2>
    <p>List : <?php echo $count;?> items</p>

    <table class="wishlist-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Date Added</th>
                <th>Stock Status</th>
                <th>Add to Cart</th>
                <th>Delete</th>
            </tr>
        </thead>

<?php
    while($details = mysqli_fetch_assoc($check))
      {

        $date = new DateTime();
           $price = $details['Price'];

$discountType = $details['DiscountType'] ?? null;
$discountValue = $details['DiscountValue'] ?? 0;
$deliverCharge = $details['Deliverycharge'] ?? 0;

// Calculate discount
if ($discountType == "Percentage") {
    $discountAmount = ($price * $discountValue) / 100;
} else {
    $discountAmount = $discountValue;
}

// Final price per item
$finalPrice = $price - $discountAmount;
if ($finalPrice < 0) {
    $finalPrice = 0;
}

// 👉 Multiply by quantity
$itemTotalPrice = $price;
$itemDiscount = $discountAmount;
$itemDelivery = $deliverCharge;

// 👉 Add to totals
$totalPrice += $itemTotalPrice;
$totalDiscount += $itemDiscount;
$totalCharge += $itemDelivery;
?>
        <tbody>
            <tr>
                <td class="product">
                    <img src="images/product/<?php echo $details['ProductImage'];?>">
                    <div>
                        <h4><?php echo $details['ProductName'];?></h4>
                        <p><?php echo $details['CategoryId']?></p>
                    </div>
                </td>
                <td>₹<?php echo $finalPrice;?></td>
                <td><?php echo $date->format("d M,D");?></td>
                <td class="stock"><?php echo $details['Availability'];?></td>
                <td><button class="wooden-cart-button" title="Add To Cart">
  <svg viewBox="0 0 24 24">
    <path
      d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 0 0 21.42 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
    ></path>
  </svg>
</button></td>
                <td class="remove">
                                      <button class="wooden-cart-button" title="Remove">
 <svg xmlns="http://www.w3.org/2000/svg" width="512" viewBox="0 0 512 512" height="512" class="svg"><title></title><path style="fill:none;stroke:white;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320"></path><line y2="112" y1="112" x2="432" x1="80" style="stroke:white;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line><path style="fill:none;stroke:white;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40"></path><line y2="400" y1="176" x2="256" x1="256" style="fill:none;stroke:white;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line y2="400" y1="176" x2="192" x1="184" style="fill:none;stroke:white;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line y2="400" y1="176" x2="320" x1="328" style="fill:none;stroke:white;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
</button>
                </td>
            </tr>
        </tbody>
        <?php
        }}
       else
            {
                ?>
                <section class="cart-items">
                    <p>No Items</p>
                </section>
                <?php }?>
    </table>
</div>
</body>
</html>