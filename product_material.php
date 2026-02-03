<?php

include('database.php');
$value="";
$mid=0;
$button="Add";

if(isset($_POST['edit']))
{
    $mid=$_POST['id'];
    $value=$_POST['name'];
    $button="Update";
}

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
<?php

include('sidebar.php');

?>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Product Materials</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Material</h3>
            <form action="product_material_action.php" method="post" id="productForm" autocomplete="off">
            <label>Material Name <s>*</s></label>
            <input type="text" id="material" name="productType" placeholder="Enter material name" value="<?php echo $value;?>" oninput="clearError()">
            <div class="error" id="materialErr"></div>
            <input type="hidden" name="mid" value="<?php echo $mid;?>">

            <button class="btn btn-save" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
            <button class="btn btn-reset" type="button" style="background-color: #071d3c !important;" onclick="resetForm()">Reset</button>
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
                    <form action="#" method="post">
                    <td>
                         
                        <!-- <a href="material_edit.php"><button class="btn-sm" style="background-color: #3333f3;">Edit</button></a> -->
                         <input type="hidden" name="id" value="<?php echo $mat['Id'];?>">
                         <input type="hidden" name="name" value="<?php echo $mat['Name'];?>">
                         <input type="submit" name="edit" class="btn-sm btn-edit" style="background-color: #3333f3;" value="Edit">
                    </td>
                    </form>

                    <form action="product_material_action.php" method="post">
                    <td>
                        <!-- <button class="btn-sm btn-delete">Delete</button> -->
                         <input type="hidden" name="id" value="<?php echo $mat['Id'];?>">
                         <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete">
                    </td>
                    </form>
                    
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