<?php
include('database.php');
$status = 0;
?>

<script src="js/jquery.min.js"></script>
<link href="css/admin_orderlist.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<div class="main">
<?php include('sidebar.php'); ?>

<div class="container-fluid content">
<div class="container details">

<h1>Order List</h1>


<div class="container">

    <div id="table-data">
        <?php

$query = "SELECT pd.`Id`, pd.`CustomerId`, pd.`CreateDate`, pd.OrderNo, ot.TotalPrice, ap.ProductImage, ap.ProductName, pd.OrderStatus, dcd.Address, dcd.Name
          FROM `payment_details` pd
          INNER JOIN delivery_customer_details dcd
                  ON dcd.Customer_Id = pd.CustomerId
          INNER JOIN order_items ot
                  ON ot.PaymentDetailsId = pd.Id
          INNER JOIN add_product ap
                  ON ap.Id = ot.ProductId
          WHERE pd.`IsDeleted` = 0 AND dcd.Status = 0 ";
        //   var_dump($query);

$result = mysqli_query($conn,$query);

?>

<table class="table table-hover table-bordered" id="tabledetails">

<thead>
<tr>
    <th>#</th>
    <th>Order ID</th>
    <th>Name</th>
    <th>Customer Name</th>
    <th>Address</th>
    <th>Date</th>
    <th>Price</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

<?php

$count = 1;

if(mysqli_num_rows($result) > 0)
{
    while($details = mysqli_fetch_assoc($result))
    {
        $date = new DateTime($details['CreateDate']);
?>

<tr>

<td><?php echo $count++; ?></td>

<td><?php echo $details['OrderNo']; ?></td>

<td class="name">
    <img src="images/product/<?php echo $details['ProductImage']; ?>" alt="">
    &emsp;
    <?php echo $details['ProductName']; ?>
</td>

<td><?php echo $details['Name']; ?></td>

<td><?php echo $details['Address']; ?></td>

<td><?php echo $date->format("d M,Y"); ?></td>

<td><?php echo $details['TotalPrice']; ?></td>

<td>
<select name="status" id="status" onchange="status(<?php echo $details['Id']?>,this.value)">
<option value="0" <?php if($details['OrderStatus'] == 0){ echo "selected"; } ?>>
    Order proccessing
</option>

<option value="1" <?php if($details['OrderStatus'] == 1){ echo "selected"; } ?>>
    Order Confirmed
</option>

<option value="2" <?php if($details['OrderStatus'] == 2){ echo "selected"; } ?>>
    Shipped
</option>

<option value="3" <?php if($details['OrderStatus'] == 3){ echo "selected"; } ?>>
    Out for Delivery
</option>

<option value="4" <?php if($details['OrderStatus'] == 4){ echo "selected"; } ?>>
    Delivered
</option>

<option value="5" <?php if($details['OrderStatus'] == 5){ echo "selected"; } ?>>
    Cancelled
</option>

</select>
</td>

</tr>

<?php
    }
}
else
{
    echo "<tr><td>No Data Found</td></tr>";
}
?>

</tbody>
</table>
    </div>
</div>
</div>
</div>

<script>
$(document).ready(function () {
    $('#tabledetails').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "ordering": true,
        "searching": true,
        "info": true,
        "responsive": true
    });
});
</script>

</body>
</html>