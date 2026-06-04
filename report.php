
<?php
include('database.php');
$status = 0;
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
<link rel="stylesheet" href="css/report.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
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
        
            <div class="profile">
          <img src="images/men_image.jpg" alt="Admin Profile" />
          <p>Admin Profile</p>
        </div>
        
    </header>

    <!-- Statistics -->
    <section class="stats-grid">

        <div class="card">
            <?php
            $select1 = "SELECT ifnull(SUM(TotalPrice),0) AS TotalPrice FROM `payment_details` WHERE OrderStatus = 4 AND IsDeleted = 0";
            $checked1 = mysqli_query($conn,$select1);

            if(mysqli_num_rows($checked1)>0)
                {
                    $revenue = mysqli_fetch_assoc($checked1);
                }
            ?>
            <h4>Total Revenue</h4>
            <h2>₹<?php echo $revenue['TotalPrice'];?></h2>
            <span class="positive">+12.5%</span>
        </div>

        <div class="card">
            <?php
            $select2 = "SELECT COUNT(1) AS Total FROM `payment_details` WHERE IsDeleted = 0";
            $cheched2 = mysqli_query($conn,$select2);

            if(mysqli_num_rows($cheched2)>0)
                {
                    $orders = mysqli_fetch_assoc($cheched2);
                }
            ?>
            <h4>Total Orders</h4>
            <h2><?php echo $orders['Total'];?></h2>
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
        </div>

        <table id="transactionTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $select = "SELECT pd.`Id`, pd.`CustomerId`, dcd.Name, `OrderNo`, `TotalPrice`, pd.OrderStatus AS StatusCode,
                            CASE
                            WHEN OrderStatus = 0 THEN 'Order Processing'
                            WHEN OrderStatus = 1 THEN 'Order Confirmed'
                            WHEN OrderStatus = 2 THEN 'Shipped'
                            WHEN OrderStatus = 3 THEN 'Out for Delivery'
                            WHEN OrderStatus = 4 THEN 'Delivered'
                            WHEN OrderStatus = 5 THEN 'Cancelled'
                            END AS
                            `OrderStatus`, DATE_FORMAT(pd.CreateDate, '%d/%m/%Y') AS createDate FROM `payment_details` pd
                            INNER JOIN delivery_customer_details dcd ON dcd.Customer_Id = pd.CustomerId
                            WHERE pd.`IsDeleted` = 0 AND dcd.Status = 0";

                $check = mysqli_query($conn,$select);

                $count = 1;
                if(mysqli_num_rows($check)>0)
                    {
                        while($datas = mysqli_fetch_assoc($check))
                            {
                ?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $datas['OrderNo'];?></td>
                    <td><?php echo $datas['Name'];?></td>
                    <td><?php echo $datas['createDate'];?></td>
                    <td>₹<?php echo $datas['TotalPrice'];?></td>
                    <?php
if($datas['StatusCode'] == 0){
    $color = '#ff9800';
}
elseif($datas['StatusCode'] == 1){
    $color = '#2196f3';
}
elseif($datas['StatusCode'] == 2){
    $color = '#9c27b0';
}
elseif($datas['StatusCode'] == 3){
    $color = '#f44336';
}
elseif($datas['StatusCode'] == 4){
    $color = '#4caf50';
}
elseif($datas['StatusCode'] == 5)
{
    $color = 'red';
}
?>

<td style="color:<?= $color ?>; font-weight:bold;">
    <?= $datas['OrderStatus'] ?>
</td>
                    <td><a href="#" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a>
<a href="#" title="Delete" style="margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></a>
</td>
                </tr>
                <?php }}?>

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

<script>
$(document).ready(function () {
    $('#transactionTable').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "ordering": true,
        "searching": true,
        "info": true,
        "responsive": true
    });
});
</script>
</html>