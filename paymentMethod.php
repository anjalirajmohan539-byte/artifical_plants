<?php

include('database.php');

$paymentId = $_GET['methodId'];
// var_dump($paymentId);

$methodId = 0;
$methodName = "";
$button = "Save";

if(isset($_POST['edit']))
{
    $methodId = $_POST['methodId'];
    $methodName =$_POST['methodName'];
    $button = "Update";
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/paymentMethod.css" rel="stylesheet">
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
    <div class="title">Payment Method</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Payment Method</h3>
            <form action="paymentMethod_action.php" method="post" id="productForm" autocomplete="off">
            <label>Payment Method <s>*</s></label>
            <input type="text" id="PaymentMethod" name="PaymentMethod" placeholder="Enter Payment Method" value="<?php echo $methodName;?>" oninput="clearError()">
            <div class="error" id="methodErr"></div>
            <input type="hidden" name="payid" value="<?php echo $paymentId;?>">
            <input type="hidden" name="methId" value="<?php echo $methodId;?>">

            <button class="btn btn-save" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
        </div>

        </form>
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Payment Method</th>
                    <th>Payment Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $select = "SELECT pm.`Id`, pm.`Name`, pc.Name AS`CategoryId` FROM `payment_method` pm
                           INNER JOIN payment_category pc ON pc.Id = pm.CategoryId
                           WHERE pc.`Id` = $paymentId AND pm.`IsDeleted` = 0";
                        //    var_dump($select);
                $statement = mysqli_query($conn,$select);

                $sl = 1;
                if(mysqli_num_rows($statement)>0)
                {
                    while($rows = mysqli_fetch_assoc($statement))
                    {

                ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $rows['Name']?></td>
                    <td><?php echo $rows['CategoryId']?></td>
                    <form action="#" method="post">
                    <td> 
                        <input type="hidden" name="methodId" id="methodId" value="<?php echo $rows['Id'];?>">
                        <input type="hidden" name="methodName" id="methodName" value="<?php echo $rows['Name'];?>">
                        <input type="submit" name="edit" class="btn-sm" style="background-color: #3333f3;" value="Edit">
                        <!-- <a href="#"><button class="btn-sm" style="background-color: #3333f3;">Edit</button></a> -->
                    </td>
                    </form>
                    <form action="paymentMethod_action.php" method="post">
                    <td>
                        <input type="hidden" name="mainId" value="<?php echo $paymentId;?>">
                        <input type="hidden" name="secondId" value="<?php echo $rows['Id'];?>">
                        <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete">
                        <!-- <button class="btn-sm btn-delete">Delete</button> -->
                    </td>
                    </form>
                    </tr>
                    <?php    }
                }?>
            </table>
        </div>

    </div>
</div>
</body>
<script>
function validateForm() {
    let paymentMethod = document.getElementById("PaymentMethod");
    let methodErr = document.getElementById("methodErr");

    let value = paymentMethod.value.trim();

    if (value === "") {
        methodErr.innerHTML = "Payment method is required";
        paymentMethod.style.border = "1px soild red";
        paymentMethod.classList.add("input-error");
        paymentMethod.focus();
        return false;
    }

    if (value.length < 3) {
        methodErr.innerHTML = "Enter at least 3 characters";
        paymentMethod.classList.add("input-error");
        paymentMethod.focus();
        return false;
    }

    methodErr.innerHTML = "";
    paymentMethod.classList.remove("input-error");

    return true; 
}


function clearError() {
    document.getElementById("methodErr").innerHTML = "";
    document.getElementById("PaymentMethod").classList.remove("input-error");
}


function resetForm() {
    document.getElementById("productForm").reset();
    document.getElementById("methodErr").innerHTML = "";
    document.getElementById("PaymentMethod").classList.remove("input-error");
}
</script>

</html>