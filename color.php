<?php

include('database.php');

$proId=$_GET['productId'];

$colorid = "";
$cname = "";
$ccode = "";
$status = 1;
$button = "Save";

if(isset($_POST['edit']))
{
    $colorid = $_POST['colorId'];
    $cname = $_POST['color'];
    $ccode = $_POST['colorCode'];
    $status = $_POST['colorStatus'];
    $button = "Update";
}


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
            <input type="text" id="color" name="color" value="<?php echo $cname;?>" placeholder="Enter color name" oninput="clearError()">
            <div class="error" id="colorErr"></div>

            <label>Color Code<s>*</s></label>
            <input type="text" id="colorCode" name="colorCode" value="<?php echo $ccode;?>" placeholder="Enter colorCode" oninput="clearError()">
            <div class="error" id="codeErr"></div>
            <input type="hidden" name="productId" value="<?php echo $proId;?>">
            <input type="hidden" name="coid" value="<?php echo $colorid?>">
            <label>Status<s>*</s></label>
            <select name="colorStatus" id="colorStatus">
                <option value="1" <?php if($status == 1) echo "selected"; ?>>Active</option>
                <option value="0" <?php if($status == 0) echo "selected"; ?>>Inactive</option>
            </select>
            <div class="error" id="statusErr"></div>

             <button class="btn btn-save" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
            </form>
        </div>

        
       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Color Code</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                
                <?php
            $colorselect = "SELECT pd.`Id`,`ProductId`,`ProductName`, pd.`ColorCode`, pd.`ColorName`, 
                              CASE WHEN Status=0 THEN 'Inactive'
                                   WHEN Status=1 THEN 'Active'
                               END AS Status,`Status` AS StatusId
                             FROM `product_color_details` pd
                            INNER JOIN add_product ap ON ap.Id = pd.ProductId WHERE ap.Id = $proId AND IsDelete = 0";
            $colorstatemnt = mysqli_query($conn,$colorselect);

            $c = 1;
            if($colorstatemnt && mysqli_num_rows($colorstatemnt)>0)
            {
                while($colors = mysqli_fetch_assoc($colorstatemnt))
                {

            ?>
            <tr>
                    <td><?php echo $c++;?></td>
                    <td><?php echo $colors['ProductName'];?></td>
                    <td><?php echo $colors['ColorName'];?></td>
                    <td><?php echo $colors['ColorCode'];?></td>
                    <td><?php echo $colors['Status'];?></td>
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="colorId" value="<?php echo $colors['Id'];?>">
                            <input type="hidden" name="color" value="<?php echo $colors['ColorName'];?>">
                            <input type="hidden" name="colorCode" value="<?php echo $colors['ColorCode'];?>">
                            <input type="hidden" name="colorStatus" value="<?php echo $colors['StatusId'];?>">
                            <input type="submit" name="edit" value="Edit" class="btn-sm" style="background-color: #3333f3 !important;">
                        <!-- <a href="category_edit.php"><button class="btn-sm" type="button" style="background-color: #3333f3 !important;">Edit</button></a> -->
                        </form>
                    </td>
                    <td>
                        <form action="color_action.php" method="post">
                            <input type="hidden" name="colorId" value="<?php echo $colors['Id'];?>">
                            <input type="hidden" name="proId" value="<?php echo $proId;?>">
                            <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete">
                        </form>
                        <!-- <button type="button" name="delete" class="btn-sm btn-delete">Delete</button> -->
                    </td>
                    </tr>
                    <?php  }  }
            ?>
                

            </table>
        </div>

    </div>
</div>

<script>
function validateForm() {
    let color = document.getElementById("color");
    let code = document.getElementById("colorCode");
    let status = document.getElementById("colorStatus");
    let colorVal = color.value.trim();
    let codeVal = code.value.trim();
    let statusVal = status.value.trim();
    let errorBox1 = document.getElementById("colorErr");
    let errorBox2 = document.getElementById("codeErr");
    let errorBox3 = document.getElementById("statusErr");

   
    errorBox1.innerText = "";
    errorBox2.innerText = "";
    errorBox3.innerText = "";
    color.style.border = "";
    code.style.border = "";
    status.style.border = "";

    
    if (materialVal === "") {
        
        errorBox1.innerText = "Color name is required";
        material.style.border = "1px solid red";
        return false;
    }

    if (colorVal === "") {
        
        errorBox2.innerText = "Code name is required";
        material.style.border = "1px solid red";
        return false;
    }

    if (statusVal === "") {
        
        errorBox3.innerText = "status name is required";
        material.style.border = "1px solid red";
        return false;
    }


    return true; 
}

function resetForm() {
    document.getElementById("color").value = "";
    document.getElementById("productForm").reset();
    clearError();
}

function clearError() {
    let material = document.getElementById("color");
    document.getElementById("materialErr").innerText = "";
    material.style.border = "";
}

</script>
</body>
</html>