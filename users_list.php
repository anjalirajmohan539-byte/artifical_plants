<?php

include('database.php');

if(isset($_GET['Status']))
{
	$status=$_GET['Status'];
  echo $status;
}

?>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/users_list.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

        <!-- SIDEBAR -->
<div class="sidebar">
    <h2>Dashboard</h2>

    <a href="admin_page.php"><img src="images/dashboard_icon.jpg" alt="">Home</a>
    <a href="add_product.php"><img src="images/add-product.png" alt="">Add Products</a>
    <a href="product_material.php"><img src="images/product_list.jpg" alt="">Product Materials</a>
    <a href="#"><img src="images/product_list.jpg" alt="">Product List</a>
    <a href="#"><img src="images/product_icon.jpg" alt="">Orders</a>
    <a href="users_list.php"><img src="images/users_icon.jpg" alt="">Customers</a>
    <a href="#"><img src="images/report_icon.jpg" alt="">Report</a>
    <a href="index.php"><img src="images/logout_icon.jpg" alt="">Logout</a>
</div>

  <!-- main content -->
   <div class="container-fluid content">
  <div class="container details">
    <h1>Users</h1>
  <table class="table table-hover table-bordered">
  <thead>
    <tr>
        <th>Sl no</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Create Date</th>
        <th></th>
    </tr>
  </thead>
  <?php
  $select="SELECT `CustomerId`, `FullName`, `PhoneNo`, `Email`, `CreateDate`,
           CASE WHEN Status =1 THEN 'Active'
                WHEN Status =2 THEN 'Inactive'
                WHEN Status =3 THEN 'Banned'
           END AS Status
          FROM `customer_details`";

          // var_dump($select);

  $statemnt=mysqli_query($conn,$select);
  $i=1;
  if(mysqli_num_rows($statemnt)>0)
{
  while($details=mysqli_fetch_assoc($statemnt))
  {

  ?>
  <tbody>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $details['FullName'];?></td>

        <td><?php echo $details['PhoneNo'];?></td>

        <td><?php echo $details['Email'];?></td>

        <td><?php echo $details['Status'];?></td>

        <td><?php echo $details['CreateDate'];?></td>

        <td><a href="users_details.php?userId=<?php echo $details['CustomerId'];?>"><button>Full details</button></a></td> 
    </tr>
  </tbody>
  <?php
   }
}
  ?>
</table>
</div>
</div>
</body>
</html>