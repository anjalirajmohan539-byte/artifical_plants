<?php

include('database.php');

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_material.css" rel="stylesheet">
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
    <div class="title">Product Materials</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Material</h3>
            <form action="product_material_action.php" method="post" id="productForm" autocomplete="off">
            <label>Material Name <s>*</s></label>
            <input type="text" id="material" name="productType" placeholder="Enter material name" oninput="clearError()">
            <div class="error" id="materialErr"></div>

            <button class="btn btn-save" name="btn" onclick="return validateForm()">Add Material</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
        </div>

        </form>
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Material</th>
                    <th>Categories</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                            <?php
                $select="SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted=0";
                $statemnt=mysqli_query($conn,$select);
                // var_dump($statemnt);

                $sl=1;

                if(mysqli_num_rows($statemnt)>0)
                {
                  while($mat=mysqli_fetch_assoc($statemnt))
                  {
                
              ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $mat['Name'];?></td>
                    <td><a href="material_category.php?matId=<?php echo $mat['Id'];?>"><button class="btn-sm">Category</button></a></td>
                    <td><button class="btn-sm" style="background-color: #3333f3;">Edit</button></td>
                    <td><button class="btn-sm btn-delete">Delete</button></td>
                </tr>
                <?php }}?>

            </table>
        </div>

    </div>
</div>

<script>
function validateForm() {
    let mat = document.getElementById("material").value.trim();

    if (mat === "") {
        document.getElementById("materialErr").innerText = "Material name is required";
        document.getElementById("material").style.border = "1px solid red";
        return false;
    }

    if (!/^[A-Za-z ]+$/.test(mat)) {
        document.getElementById("materialErr").innerText = "Only letters allowed";
        return false;
    }

    alert("Material added successfully");
    return true;
}

function resetForm() {
    document.getElementById("material").value = "";
    clearError();
}

function clearError() {
    document.getElementById("materialErr").innerText = "";
    document.getElementById("material").style.border = "";
}
</script>
</body>
</html>