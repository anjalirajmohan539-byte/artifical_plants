<?php

include('database.php');

$proId=$_GET['productId'];

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/color.css" rel="stylesheet">
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

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Color Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Color</h3>
            <form action="color_action.php" method="post" id="productForm" autocomplete="off">
            <label>Color Name<s>*</s></label>
            <input type="text" id="color" name="color" value="" placeholder="Enter color name" oninput="clearError()">
            <div class="error" id="materialErr"></div>

            <label>Color Code<s>*</s></label>
            <input type="text" id="colorCode" name="colorCode" value="" placeholder="Enter colorCode" oninput="clearError()">
            <div class="error" id="materialErr"></div>
            <input type="hidden" name="productId" value="<?php echo $proId;?>">

            <?php
            $select = "SELECT `Id`, `Status` FROM `product_color_details` WHERE  IsDelete= 0";
            $statemnt = mysqli_query($conn,$select);

            if(mysqli_num_rows($statement)>0)
            {
                $status = mysqli_fetch_assoc($statement);

            ?>
            <label>Status<s>*</s></label>
            <select name="colorStatus" id="colorStatus">
                <option value="#"></option> 
            </select>
            <div class="error" id="materialErr"></div>
            <?php }?>

             <button class="btn btn-save" name="btn" onclick="return validateForm()">Save</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
            </form>
        </div>

        
       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <?php
            $colorselect = "SELECT `Id`, `ProductId`, `ColorCode`, `ColorName`, `Status` FROM `product_color_details` WHERE IsDelete = 0";
            ?>
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Color Code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="category_edit.php"><button class="btn-sm" type="button" style="background-color: #3333f3 !important;">Edit</button></a>
                    </td>
                    <td>
                        <button type="button" name="delete" class="btn-sm btn-delete">Delete</button>
                    </td>
                </tr>

            </table>
        </div>

    </div>
</div>
</body>
</html>