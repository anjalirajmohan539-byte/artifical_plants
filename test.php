<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer orderlist</title>
    <link rel="stylesheet" href="css/test.css">
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
                <span>Hello, Anjali</span>
                <div class="avatar">
                    <img src="images/img/girl_image.png" alt="User Avatar">
                </div>
            </div>
        </div>
    </header>

    <main>

        <section class="page-header">
            <h1>My Orders</h1>
            <div class="filter-tabs">
                <button class="tab-btn active">All Orders</button>
                <button class="tab-btn">Processing</button>
                <button class="tab-btn">Shipped</button>
                <button class="tab-btn">Delivered</button>
                <button class="tab-btn">Cancelled</button>
            </div>
        </section>

        <div class="order-list" id="orderListContainer">

            <article class="order-card" data-status="delivered">
                <div class="card-header">
                    <div class="order-info-left">
                        <span class="order-id">Order #ORD-7829</span>
                        <span class="order-date">Placed on Oct 24, 2023</span>
                    </div>
                    <span class="status-badge status-delivered">Delivered</span>
                </div>
                <div class="card-body">
                    <div class="product-images">
                        <img src="images/plant_5.png" alt="Product" class="product-img">
                        <img src="images/artificial_plants_3.jpg" alt="Product" class="product-img">
                    </div>
                    <div class="order-details">
                        <h3 class="product-title">indoor Plants</h3>
                        <p class="product-meta">Qty: 2 Items </p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="total-price">₹299.00</div>
                    <div class="action-buttons">
                        <a href="#" class="btn btn-outline">View Details</a>
                        <a href="#" class="btn btn-primary">Buy Again</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- <div class="empty-state" id="emptyState">
            <h3>No orders found</h3>
            <p>You don't have any orders in this category.</p>
            <button class="btn btn-primary" onclick="resetFilters()">View All Orders</button>
        </div> -->

    </main>

</body>
</html>









