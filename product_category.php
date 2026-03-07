<?php

include('database.php');
$cate="";
$des="";
$mid=0;
$button="Add";

if(isset($_POST['edit']))
{
    $mid=$_POST['id'];
    $cate=$_POST['name'];
    $des=$_POST['des'];
    $button="Update";
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_category.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet">
</head>

<body>
<!-- SIDEBAR -->
<?php

include('sidebar.php');

?>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Product Category</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Product Category</h3>
            <form action="product_category_action.php" method="post" id="productForm" autocomplete="off">
            <label>Catgeory Name <s>*</s></label>
            <input type="text" id="category" name="Catgeory" placeholder="Enter category" value="<?php echo $cate;?>" oninput="clearError()">
            <div class="error" id="cateErr"></div>

            <label>Description <s>*</s></label>
            <input type="text" id="description" name="Description" placeholder="Enter description" value="<?php echo $des;?>" oninput="clearError()">
            <div class="error" id="desErr"></div>
            <input type="hidden" name="mid" value="<?php echo $mid;?>">

            <button class="btn btn-save" id="add" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
            <button class="btn btn-reset" type="button" style="background-color: #071d3c !important;" onclick="resetForm()">Reset</button>
        </div>

        </form>
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                            <?php
                $select="SELECT `Id`, `Categorys`, `Description` FROM `product_category` WHERE `IsDeleted` = 0";
                $statemnt=mysqli_query($conn,$select);

                $sl=1;

                if(mysqli_num_rows($statemnt)>0)
                {
                  while($cat=mysqli_fetch_assoc($statemnt))
                  {
                
              ?>
                <tr>
                   
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $cat['Categorys'];?></td>
                    <td><?php echo $cat['Description'];?></td>
                    <form action="#" method="post">
                    <td>
                         
                         <input type="hidden" name="id" value="<?php echo $cat['Id'];?>">
                         <input type="hidden" name="name" value="<?php echo $cat['Categorys'];?>">
                         <input type="hidden" name="des" value="<?php echo $cat['Description'];?>">
                         <input type="submit" name="edit" class="btn-sm btn-edit" style="background-color: #3333f3;" value="Edit">
                    </td>
                    </form>

                    <form action="product_category_action.php" method="post">
                    <td>

                         <input type="hidden" name="id" value="<?php echo $cat['Id'];?>">
                         <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete">
                    </td>
                    </form>
                    
                </tr>
                <?php }}?>

            </table>
        </div>

    </div>
</div>

</body>
<script>
    function validateForm()
    {
        let category = document.getElementById('category');
        let description = document.getElementById('description');
        let caterror = document.getElementById('cateErr');
        let deserror = document.getElementById('desErr');
        let f=0;
        

if(category.value === "")
{
    category.style.border="1px solid red";
    caterror.innerhtml="Please enter category";
    f=1
}

if(description.value === "")
{
    description.style.border="1px solid red";
    deserror.innerhtml = "Please enter description";
   f=1
}

if(f==1)
{
    return false;
}
    }
</script>
</html>