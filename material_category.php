<?php
include('database.php');

  $id = $_GET['matId'];

?>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/material_category.css" rel="stylesheet">
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
    <div class="title">Categorys Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Categorys</h3>
            <form action="material_category_action.php" method="post" id="productForm" autocomplete="off">
            <label>Material Categorys <s>*</s></label>
            <input type="text" id="material" name="productType" placeholder="Enter material name" oninput="clearError()">
            <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">
            <div class="error" id="materialErr"></div>

            <button class="btn btn-save" name="btn" type="submit" onclick="return validateForm()">Add Categorys</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
            </form>
        </div>

        

       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Material Categories</th>
                    <th>Material Types</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
               <?php
            
                $select="SELECT mc.`Id`, mc.`Name`,mt.Name AS `Type` FROM `material_category` mc
                        INNER JOIN material_type mt ON mt.Id = mc.Type WHERE mt.Id=$id AND IsDelete=0";
                $statemnt=mysqli_query($conn,$select);
                // var_dump($select);

                $c=1;

                if(mysqli_num_rows($statemnt)>0)
                {
                  while($cat=mysqli_fetch_assoc($statemnt))
                  {
              
                ?>
                <tr>
                    <td><?php echo $c++;?></td>
                    <td><?php echo $cat['Name'];?></td>
                    <td><?php echo $cat['Type'];?></td>
                    <td><a href="category_edit.php"><button class="btn-sm" type="button" style="background-color: #3333f3 !important;">Edit</button></a></td>
                    <td><button type="button" class="btn-sm btn-delete">Delete</button></td>
                </tr>
                <?php }}?>

            </table>
        </div>

    </div>
</div>

<script>
function validateForm() {
    let material = document.getElementById("material");
    let materialVal = material.value.trim();
    let errorBox = document.getElementById("materialErr");

   
    errorBox.innerText = "";
    material.style.border = "";

    
    if (materialVal === "") {
        
        errorBox.innerText = "Category name is required";
        material.style.border = "1px solid red";
        return false;
    }


    return true; 
}

function resetForm() {
    document.getElementById("material").value = "";
    clearError();
}

function clearError() {
    let material = document.getElementById("material");
    document.getElementById("materialErr").innerText = "";
    material.style.border = "";
}
</script>


</body>
</html>