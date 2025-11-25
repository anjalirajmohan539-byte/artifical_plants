<?php

include('database.php');

$productid = $_GET['productId'];

$imgs = "";
$imgId = "";
$button = "Save";

if(isset($_POST['edit']))
{
    $imgId = $_POST['id'];
    $imgs =$_POST['img'];
    $button = "Update";
}

    

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/image.css" rel="stylesheet">
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
            
            <h3 style="margin-bottom: 15px;">Add New Image</h3>
            <form action="image_action.php" method="post" id="productForm" autocomplete="off" enctype="multipart/form-data">
            <label>Image<s>*</s></label><br>
            <div class="card-right">

            <div class="avatar-preview" id="avatarBox">
        <div style="text-align:center;padding:10px;color:var(--muted)">
          <div style="font-size:18px;font-weight:700">Welcome!</div>
          <div class="small">Upload a photo to preview here.</div>
        </div>
        
        <img src="images/product/<?php echo $imgs;?>" alt="">
      </div>
      </div>

            <input type="file" id="image" name="image" value="" oninput="clearError()">
            <input type="hidden" name="proId" value="<?php echo $productid;?>">
            <input type="hidden" name="imageId" value="<?php echo $imgId;?>">
            <div class="error" id="materialErr"></div>


             <button class="btn btn-save" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
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
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php
                $select = "SELECT pi.`Id`,`ProductName`, pi.`Images`, `ProductId` FROM `product_images` pi
                           INNER JOIN add_product ap ON ap.Id = pi.ProductId WHERE ap.Id = $productid AND IsDelete = 0";
                $statemnt = mysqli_query($conn,$select);
                
                $i = 1;

                if(mysqli_num_rows($statemnt)>0)
                {
                    while($image = mysqli_fetch_assoc($statemnt))
                    {

                ?>
            <tr>
                    <td><?php echo $i++;?></td>
                    <td><img src="images/product/<?php echo $image['Images'];?>" alt="" style="width: 100%"></td>
                    <td style="width: 63%;"><?php echo $image['ProductName'];?></td>
                    <td style="width: 3%;">
                        <form action="#" method="post">
                            <input type="hidden" name="id" value="<?php echo $image['Id'];?>">
                            <input type="hidden" name="img" value="<?php echo $image['Images'];?>">
                            <input type="submit" name="edit" class="btn-sm" value="Edit" style="background-color: #3333f3 !important;">
                        </form>
                        <!-- <a href="category_edit.php"><button class="btn-sm" type="button" style="background-color: #3333f3 !important;">Edit</button></a> -->
                    </td>
                    <td>
                        <form action="image_action.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $image['Id'];?>">
                            <input type="hidden" name="pid" value="<?php echo $productid;?>">
                            <input type="submit" name="delete" value="Delete" class="btn-sm btn-delete">
                        </form>
                        <!-- <button type="button" name="delete" class="btn-sm btn-delete">Delete</button> -->
                    </td>
                    </tr>
                    <?php    }
                }?>
                

            </table>
        </div>

    </div>
</div>

<script>
    const avatarInput = document.getElementById('image');
    const avatarBox = document.getElementById('avatarBox');

    avatarInput.addEventListener('change', (e)=>{
      const f = e.target.files && e.target.files[0];
      if(!f) return;
      const url = URL.createObjectURL(f);
      avatarBox.innerHTML = '';
      const img = document.createElement('img'); img.src = url; img.alt = 'image';
      avatarBox.appendChild(img);
    });

</script>
</body>
</html>