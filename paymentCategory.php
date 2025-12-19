<?php

include('database.php');

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/paymentCategory.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
        <!-- SIDEBAR -->
<div class="sidebar">
    <h2>Dashboard</h2>

    <a href="admin_page.php"><img src="images/dashboard_icon.jpg" alt=""><y>Home</y></a>
    <a href="add_product.php"><img src="images/add-product.png" alt=""><y>Add Products</y></a>
    <a href="product_material.php"><img src="images/product_list.jpg" alt=""><y>Product Materials</y></a>
    <a href="#"><img src="images/product_list.jpg" alt=""><y>Product List</y></a>
    <a href="#"><img src="images/product_icon.jpg" alt=""><y>Orders</y></a>
    <a href="users_list.php"><img src="images/users_icon.jpg" alt=""><y>Customers</y></a>
    <a href="#"><img src="images/report_icon.jpg" alt=""><y>Report</y></a>
    <a href="index.php"><img src="images/logout_icon.jpg" alt=""><y>Logout</y></a>
</div>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Payment Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Payment Category</h3>
            <form action="paymentCategory_action.php" method="post" id="productForm" autocomplete="off">
            <label>Payment Category <s>*</s></label>
            <input type="text" id="Payment" name="Payment" placeholder="Enter Payment Category" value="" oninput="clearError()">
            <div class="error" id="PaymentErr"></div>
            <input type="hidden" name="mid" value="">

            <button class="btn btn-save" name="btn" onclick="return validateForm()">Save</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
        </div>

        </form>
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Payment Category</th>
                    <th>Payment Method</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                                   <?php
                   $select = "SELECT `Id`, `Name` FROM `payment_category` WHERE `IsDeleted` = 0";
                   $check = mysqli_query($conn,$select);

                   $sl = 1;
                   if(mysqli_num_rows($check)>0)
                   {
                    while($rows=mysqli_fetch_assoc($check))
                    {

                   ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $rows['Name'];?></td>
                    <td><a href="paymentMethod.php?methodId=<?php echo $rows['Id'];?>"><button class="btn-sm">Method</button></a></td>
                    <td> 
                        <a href="#"><button class="btn-sm" style="background-color: #3333f3;">Edit</button></a>
                    </td>
                    <td>
                        <button class="btn-sm btn-delete">Delete</button>
                    </td>
                    </tr>
                    <?php }
                   }?>
                

            </table>
        </div>

    </div>
</div>
</body>
</html>