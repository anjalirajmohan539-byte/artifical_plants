<?php
include('database.php');

if(isset($_POST['type'])) {

    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $select = "SELECT ap.Id, ap.ProductImage, ap.ProductName, ap.Price, ct.Name AS CategoryTypeId
               FROM add_product ap
               INNER JOIN category_type ct ON ct.Id = ap.CategoryTypeId
               WHERE ap.IsDeleted = 0 
               AND ap.CategoryId = 4 
               AND CategoryTypeId = '$type'";
               

    $check = mysqli_query($conn, $select);

    if($check && mysqli_num_rows($check) > 0) {

        while($vase = mysqli_fetch_assoc($check)) {

            $sql = "SELECT DeliveryDays FROM shipping_details WHERE ProductId = '{$vase['Id']}'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $days = $row['DeliveryDays'] ?? 4;

            $date = new DateTime();
            $date->modify("+$days days");
?>
            <div class="col-3 product-card">
                <a href="product_details.php?productId=<?php echo $vase['Id']; ?>">
                    <img src="images/product/<?php echo $vase['ProductImage']; ?>">
                    <h3><?php echo $vase['ProductName']; ?></h3>
                    <p><span>₹<?php echo number_format($vase['Price']); ?></span></p>
                    <p>Delivery by <?php echo $date->format("d M, D"); ?></p>
                </a>
            </div>
<?php
        }

    } else {
        echo "<h3 style='padding:20px'>No products found</h3>";
    }
}
?>