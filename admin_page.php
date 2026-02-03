<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/admin_page.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>

        <!-- SIDEBAR -->
<?php

include('sidebar.php');

?>

     <!-- Main Content -->
    <main class="main-content">
      <header class="topbar">
        <h1><span>Admin</span> Dashboard</h1>
        <div class="profile">
          <img src="images/men_image.jpg" alt="Admin Profile" />
          <p>Admin Profile</p>
        </div>
      </header>

      <!-- Dashboard Cards -->
      <section class="cards">
        <div class="card"><h3>Sales</h3><h2>2.382</h2><p class="down">-3.65% Since last week</p></div>
        <div class="card"><h3>Earnings</h3><h2>21.300</h2><p class="up">+6.65% Since last week</p></div>
        <div class="card"><h3>Order</h3><h2>2.382</h2><p class="down">-3.65% Since last week</p></div>
        <div class="card"><h3>Delivered</h3><h2>21.300</h2><p class="up">+6.65% Since last week</p></div>
        <div class="card"><h3>Total Customer</h3><h2>14.212</h2><p class="up">+5.25% Since last week</p></div>
        <div class="card"><h3>Active Users</h3><h2>64</h2><p class="down">-2.25% Since last week</p></div>
        <div class="card"><h3>InActive Users</h3><h2>14.212</h2><p class="up">+5.25% Since last week</p></div>
        <div class="card"><h3>Banned Users</h3><h2>64</h2><p class="down">-2.25% Since last week</p></div>
      </section>

      <!-- Graph Section -->
      <section class="charts">
        <div class="chart-card">
          <h3>Recent Movement</h3>
          <canvas id="recentMovementChart"></canvas>
        </div>
        <div class="chart-card">
          <h3>Monthly Sales</h3>
          <canvas id="monthlySalesChart"></canvas>
        </div>
      </section>

      <!-- Products Section -->
      <section class="products">
        <h2>Most Selling Product</h2>
        <div class="product-list">
          <div class="product-card">
            <img src="images/plant_3" alt="">
            <p>Artificial plant</p>
            <div class="price">₹9,999 <span>MRP ₹13,000</span></div>
          </div>
          <div class="product-card">
            <img src="images/plant_3" alt="">
            <p>Artificial plant</p>
            <div class="price">₹9,999 <span>MRP ₹13,000</span></div>
          </div>
          <div class="product-card">
            <img src="images/plant_3" alt="">
            <p>Artificial plant</p>
            <div class="price">₹9,999 <span>MRP ₹13,000</span></div>
          </div>
          <div class="product-card">
            <img src="images/plant_3" alt="">
            <p>Artificial plant</p>
            <div class="price">₹9,999 <span>MRP ₹13,000</span></div>
          </div>
		  <div class="product-card">
            <img src="images/plant_3" alt="">
            <p>Artificial plant</p>
            <div class="price">₹9,999 <span>MRP ₹13,000</span></div>
          </div>
        </div>
      </section>
    </main>
  </div>








  <!-- JavaScript for Charts -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Recent Movement Line Chart
    const ctx1 = document.getElementById('recentMovementChart').getContext('2d');
    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Visitors',
          data: [1200, 1900, 3000, 2500, 2800, 3200, 4100],
          borderColor: '#0c192b',
          backgroundColor: '#023275ff',
          fill: true,
          tension: 0.3,
          pointRadius: 4,
          pointBackgroundColor: '#0c192b'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: '#eee' } },
          x: { grid: { display: false } }
        }
      }
    });

    // Monthly Sales Bar Chart
    const ctx2 = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        datasets: [{
          label: 'Sales (in ₹000)',
          data: [15, 22, 18, 25, 28, 35, 40, 38, 45],
          backgroundColor: '#023275ff',
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: '#eee' } },
          x: { grid: { display: false } }
        }
      }
    });
  </script>
</body>
</html>