
<?php
include('database.php');

$months = [];
$revenues = [];

$sql = "SELECT MONTHNAME(ot.CreateDate) AS Month,SUM(ot.TotalPrice) AS Revenue FROM order_items ot
        INNER JOIN payment_details pd ON pd.Id = ot.PaymentDetailsId
        WHERE pd.OrderStatus = 0 GROUP BY MONTH(ot.CreateDate) ORDER BY MONTH(ot.CreateDate)";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
    $months[] = $row['Month'];
    $revenues[] = $row['Revenue'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Report Dashboard</title>
<link rel="stylesheet" href="css/test.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
<?php
include('sidebar.php');
?>
</aside>

<!-- Main Content -->
<div class="main-content">

    <!-- Header -->
    <header class="header">
        <div>
            <h1>Sales Reports</h1>
            <p>Overview of your store performance</p>
        </div>

        <button class="date-btn">Last 30 Days</button>
        
            <div class="profile">
          <img src="images/men_image.jpg" alt="Admin Profile" />
          <p>Admin Profile</p>
        </div>
        
    </header>

    <!-- Statistics -->
    <section class="stats-grid">

        <div class="card">
            <h4>Total Revenue</h4>
            <h2>₹124,592</h2>
            <span class="positive">+12.5%</span>
        </div>

        <div class="card">
            <h4>Total Orders</h4>
            <h2>1,482</h2>
            <span class="positive">+8.2%</span>
        </div>

        <div class="card">
            <h4>Avg Order Value</h4>
            <h2>₹84.07</h2>
            <span class="positive">+2.1%</span>
        </div>

    </section>

    <!-- Charts Section -->
    <section class="chart-section">

        <div class="chart-card">
            <h3>Revenue Analytics</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Top Categories</h3>

            <div class="donut-placeholder">
                100%
            </div>

            <ul class="legend">
                <li>Artifical plants - 45%</li>
                <li>Decors - 25%</li>
                <li>Vases - 20%</li>
                <li>Rocks - 10%</li>
            </ul>
        </div>

    </section>

    <!-- Transactions Table -->
    <section class="table-section">

        <div class="table-top">
            <h3>Recent Transactions</h3>

            <input type="text" placeholder="Search Orders">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>#ORD-001</td>
                    <td>Alice Freeman</td>
                    <td>24-10-2023</td>
                    <td>₹120.50</td>
                    <td><span class="completed">Completed</span></td>
                    <td><a href="#" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a></td>
                </tr>

                <tr>
                    <td>#ORD-002</td>
                    <td>Mark Wilson</td>
                    <td>24-10-2023</td>
                    <td>₹450.00</td>
                    <td><span class="pending">Pending</span></td>
                    <td><a href="#" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a></td>
                </tr>

                <tr>
                    <td>#ORD-003</td>
                    <td>Louisa Clark</td>
                    <td>23-10-2023</td>
                    <td>₹75.25</td>
                    <td><span class="cancelled">Cancelled</span></td>
                    <td><a href="#" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a></td>
                </tr>

                <tr>
                    <td>#ORD-004</td>
                    <td>James Smith</td>
                    <td>23-10-2023</td>
                    <td>₹210.00</td>
                    <td><span class="completed">Completed</span></td>
                    <td><a href="#" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a></td>
                </tr>
            </tbody>
        </table>

    </section>

</div>

</body>
<script>
const graph = document.getElementById('revenueChart');

new Chart(graph, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Revenue',
            data: <?php echo json_encode($revenues); ?>,
            borderColor: '#4f46e5',
            backgroundColor: 'rgba(79,70,229,0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Monthly Revenue Analytics'
            }
        }
    }
});
</script>
</html>