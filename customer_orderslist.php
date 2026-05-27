<?php
include('database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer orderlist</title>
    <link rel="stylesheet" href="css/customer_orderslist.css">
</head>
<body>

    <header>
        <div class="nav-container">
            <a href="#" class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                MILON
            </a>
            <div class="user-menu">
                <?php
                $select1 = "SELECT `UserImage`, `FullName` FROM `customer_details` WHERE  `IsDeleted` = 0 AND `CustomerId` = 2";
                $checksele = mysqli_query($conn,$select1);

                if(mysqli_num_rows($checksele)>0)
                    {
                        $data = mysqli_fetch_assoc($checksele);
                ?>
                <span>Hello, <?php echo $data['FullName']?></span>
                <div class="avatar">
                    <img src="images/img/<?php echo $data['UserImage'];?>" alt="User Avatar">
                </div>
                <?php }?>
            </div>
        </div>
    </header>

    <main>

        <section class="page-header">
            <h1>My Orders</h1>
            <div class="filter-tabs">
                <button class="tab-btn active">All Orders</button>
                <button class="tab-btn">Confirm Orders</button>
                <button class="tab-btn">Shipped</button>
                <button class="tab-btn">Out for Delivery</button>
                <button class="tab-btn">Delivered</button>
            </div>
        </section>

        <div class="order-list" id="orderListContainer">
            <?php
            $select = "SELECT pd.`Id`, `CustomerId`, ap.ProductImage, ap.ProductName, ot.TotalPrice, `ShippingDetailsId`, `OrderNo`, 
                        CASE OrderStatus
                        WHEN 0 THEN 'Order proccessing'
                        WHEN 1 THEN 'Order Confirmed'
                        WHEN 2 THEN 'Shipped'
                        WHEN 3 THEN 'Out For Delivery'
                        WHEN 4 THEN 'Delivered'
                       END AS OrderStatus, ot.ProductCount FROM `payment_details` pd
                        INNER JOIN order_items ot ON ot.PaymentDetailsId = pd.Id
                        LEFT JOIN shipping_details sd ON sd.ProductId = ot.ProductId
                        INNER JOIN add_product ap ON ap.Id = ot.ProductId
                       WHERE pd.`IsDeleted` = 0 AND pd.CustomerId = 2";

            $check = mysqli_query($conn,$select);

            if(mysqli_num_rows($check)>0)
                {
                    while($order = mysqli_fetch_assoc($check))
                        {
            ?>
            <article class="order-card" data-status="delivered">
                <div class="card-header">
                    <div class="order-info-left">
                        <span class="order-id">Order #<?php echo $order['OrderNo'];?></span>
                        <span class="order-date">Placed on Oct 24, 2023</span>
                    </div>
                    <span class="status-badge status-delivered"><?php echo $order['OrderStatus'];?></span>
                </div>
                <div class="card-body">
                    <div class="product-images">
                        <img src="images/product/<?php echo $order['ProductImage'];?>" alt="Product" class="product-img">
                    </div>
                    <div class="order-details">
                        <h3 class="product-title"><?php echo $order['ProductName'];?></h3>
                        <p class="product-meta">Qty: <?php echo $order['ProductCount'];?> Items </p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="total-price">₹<?php echo $order['TotalPrice'];?></div>
                    <div class="action-buttons">
                        <a href="#" class="btn btn-outline">View Details</a>
                        <a href="#" class="btn btn-primary" <?php if($order['OrderStatus'] == 4){echo "Active";}?>>Buy Again</a>
                    </div>
                </div>
            </article>
            <?php }}?>
        </div>

        <!-- <div class="empty-state" id="emptyState">
            <h3>No orders found</h3>
            <p>You don't have any orders in this category.</p>
            <button class="btn btn-primary" onclick="resetFilters()">View All Orders</button>
        </div> -->

    </main>

</body>
</html>