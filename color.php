<?php

include('database.php');

$proId=$_GET['productId'];

$colorid = "";
$cname = "";
$ccode = "";
$status = 1;
$button = "Add";

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
            <input type="text" id="color" name="color" value="<?php echo $cname;?>" placeholder="Enter color name" oninput="clearError('colorErr')">
            <div class="error" id="colorErr"></div>

            <label>Color Code<s>*</s></label>
            <input type="text" id="colorCode" name="colorCode" value="<?php echo $ccode;?>" placeholder="Enter color Code" oninput="clearError('codeErr')">
            <div class="error" id="codeErr"></div>
            <input type="hidden" name="productId" value="<?php echo $proId;?>">
            <input type="hidden" name="coid" value="<?php echo $colorid?>">
            <label>Status<s>*</s></label>
            <select name="colorStatus" id="colorStatus">
                <option value="1" <?php if($status == 1) echo "selected"; ?>>Active</option>
                <option value="0" <?php if($status == 0) echo "selected"; ?>>Inactive</option>
            </select>

             <button class="btn btn-save" id="add" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
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
                            <input type="hidden" id="oldColor" name="color" value="<?php echo $colors['ColorName'];?>">
                            <input type="hidden" id="oldCode" name="colorCode" value="<?php echo $colors['ColorCode'];?>">
                            <input type="hidden" id="status" name="colorStatus" value="<?php echo $colors['StatusId'];?>">
                            <!-- <input type="submit" name="edit" value="Edit" class="btn-sm" style="background-color: #3333f3 !important;"> -->
                        <button type="submit" name="edit" style="border:none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
                        </form>
                    </td>
                    <td>
                        <form action="color_action.php" method="post">
                            <input type="hidden" name="colorId" value="<?php echo $colors['Id'];?>">
                            <input type="hidden" name="proId" value="<?php echo $proId;?>">
                            <!-- <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete"> -->
                            <button type="submit" name="delete" style="border:none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                        </form>
                        
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
    let isValid = true;

    let color = document.getElementById("color").value.trim();
    let colorCode = document.getElementById("colorCode").value.trim();

    clearError('colorErr');
    clearError('codeErr');

    if (color === "") {
        document.getElementById("colorErr").innerHTML = "Please enter color name";
        isValid = false;
    }

    if (colorCode === "") {
        document.getElementById("codeErr").innerHTML = "Please enter color code";
        isValid = false;
    }

    return isValid;
}

function clearError(id) {
    document.getElementById(id).innerHTML = "";
}

function resetForm()
{
    let add = document.getElementById('add');
    clearError('colorErr');
    clearError('codeErr');

    document.getElementById("color").value ="";
    document.getElementById("colorCode").value = "";
    document.getElementById("colorStatus").value = "1";
    document.getElementById("add").innerText = "Add";

}
</script>
</body>
</html>