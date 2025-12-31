<?php

include('database.php');

$pId = $_GET['productId'];

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_pair.css" rel="stylesheet">
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
    <div class="title">Product Pair Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add Product Pair</h3>
            <form action="product_pair_action.php" method="post" id="productForm" autocomplete="off">

            <label>Image<s>*</s></label>
            <input type="file" id="Image" name="Image" value="" oninput="clearError('codeErr')">
            <div class="error" id="codeErr"></div>

            <label>Name<s>*</s></label>
            <input type="text" id="Name" name="Name" value="" placeholder="Enter pair name" oninput="clearError('colorErr')">
            <input type="hidden" name="product_Id" id="product_Id" value="<?php echo $pId;?>">
            <div class="error" id="colorErr"></div>

            <label style="margin-right: 10px;">Price<s>*</s></label>
            <input type="text" id="Price" name="Price" value="" placeholder="Enter pair name" oninput="clearError('colorErr')">
            <div class="error" id="colorErr"></div>

            <label>Description<s>*</s></label>
            <textarea name="Description" id="Description"></textarea>
            <div class="error" id="codeErr"></div>


             <button class="btn btn-save" id="add" name="btn" onclick="return validateForm()">Save</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
            </form>
        </div>

        
       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            <tr>
                    <td></td>
                    <td><img src="#" alt=""></td>
                    <td></td>
                    <td>
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="img" value="">
                            <button type="submit" name="edit" style="border:none;" title="Edit"></button>
                        
                    </td>
                    <td>
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="pid" value="">
                            <button type="submit" name="delete" style="border:none;" title="Delete"></button>
                    </td>
                    </tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>