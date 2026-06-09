<?php
include('database.php');

include('header.php');
?>

<script src="js/jquery.min.js"></script>
<link href="css/customer_tracking_page.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<link rel="stylesheet" href="bootstrap/bootstrap.min(css).css">

<div class="main">

<div class="container-fluid content">
<div class="container details">

<h1>Track your Order</h1>

<div class="container">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<div class="container padding-bottom-3x mb-1">
        <div class="card mb-3">
          <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Tracking Order No - </span><span class="text-medium">34VB5540K83</span></div>
          <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-config"></i></div>
                </div>
                <h4 class="step-title">Processing Order</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cart"></i></div>
                </div>
                <h4 class="step-title">Confirmed Order</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-medal"></i></div>
                </div>
                <h4 class="step-title">Shipping</h4>
              </div>
              <div class="step">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-car"></i></div>
                </div>
                <h4 class="step-title">Out for Delivery</h4>
              </div>
              <div class="step">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Product Delivered</h4>
              </div>
              <div class="step">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Cancelled</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>


<div class="container">

    <div id="table-data">
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
</div>
</div>
</div>  
</body>
</html>