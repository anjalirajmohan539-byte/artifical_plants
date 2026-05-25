<?php
include('database.php');

?>

<link href="css/admin_orderlist.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<div class="main">
    <?php
    include('sidebar.php');
    ?>
  <div class="container-fluid content">
  <div class="container details">
    <h1>Order List</h1>

  <table class="table table-hover table-bordered">
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
    $select = "SELECT pd.`Id`, pd.`CustomerId`, pd.`CreateDate`, pd.OrderNo, ot.TotalPrice, ap.ProductImage, ap.ProductName, pd.OrderStatus, dcd.Address, dcd.Name FROM `payment_details` pd
                INNER JOIN delivery_customer_details dcd ON dcd.Customer_Id = pd.CustomerId
                INNER JOIN order_items ot ON ot.PaymentDetailsId = pd.Id
                INNER JOIN add_product ap ON ap.Id = ot.ProductId
               WHERE pd.`IsDeleted` = 0 AND dcd.Status = 0 ";

    $check = mysqli_query($conn,$select);

    $count = 1;
    if(mysqli_num_rows($check)>0)
        {
            while($details = mysqli_fetch_assoc($check))
                {
                    $date = new DateTime($details['CreateDate']);
    ?>
    <tr>
        <td><?php echo $count++;?></td>
        <td><?php echo $details['OrderNo'];?></td>
        <td><img src="images/product/<?php echo $details['ProductImage'];?>" alt="">&emsp;<?php echo $details['ProductName'];?></td>
        <td><?php echo $details['Name'];?></td>
        <td><?php echo $details['Address'];?></td>
        <td><?php echo $date->format("d M,D");?></td>
        <td><?php echo $details['TotalPrice'];?></td>
        <td>
            <select name="status" id="status">
                <option value="<?php ?>"></option>
            </select>
        </td> 
    </tr>
    <?php
    }}
    ?>
  </tbody>
</table>
</div>
</div>
</body>
</html>