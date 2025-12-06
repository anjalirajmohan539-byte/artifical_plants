<?php

include('database.php');

$productid = $_GET['productId'];

$imgs = "";
$imgId = "";
$button = "Add";

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
        <div style="text-align:center;padding:10px;color:var(--muted);<?php echo $imgs != "" ? 'display:none' : ''?>">
          <div style="font-size:18px;font-weight:700">Welcome!</div>
          <div class="small">Upload a photo to preview here.</div>
        </div>
        <?php
        if($imgs != '')
        {

        ?>
        
        <img src="images/product/<?php echo $imgs;?>" alt="">
        <?php }?>
      </div>
      </div>

            <input type="file" id="image" name="image" value="" oninput="clearError('imageErr')">
            <input type="hidden" name="proId" value="<?php echo $productid;?>">
            <input type="hidden" name="imageId" value="<?php echo $imgId;?>">
            <div class="error" id="imageErr"></div>


             <button class="btn btn-save" id="add" name="btn" onclick="return validateForm()"><?php echo $button;?></button>
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
                    <td><img src="images/product/<?php echo $image['Images'];?>" alt="" style="width: 60%"></td>
                    <td style="width: 63%;"><?php echo $image['ProductName'];?></td>
                    <td style="width: 3%;">
                        <form action="#" method="post">
                            <input type="hidden" name="id" value="<?php echo $image['Id'];?>">
                            <input type="hidden" name="img" value="<?php echo $image['Images'];?>">
                           
                            <button type="submit" name="edit" style="border:none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
                        </form>
                        
                    </td>
                    <td>
                        <form action="image_action.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $image['Id'];?>">
                            <input type="hidden" name="pid" value="<?php echo $productid;?>">
                            
                            <button type="submit" name="delete" style="border:none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                        </form>
                        
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



    function validateForm() {
        const image = document.getElementById("image").value;
        let isValid = true;

        document.getElementById("imageErr").innerHTML = "";

        if (image.trim() == "") {
            document.getElementById("imageErr").innerHTML = "Please upload an image.";
            isValid = false;
        }

        return isValid;
    }

    function clearError(id) {
        document.getElementById(id).innerHTML = "";
    }

    function resetForm() {

        let add = document.getElementById("add");
        document.getElementById("productForm").reset();
        avatarBox.innerHTML = `
            <div style="text-align:center;padding:10px;color:var(--muted);">
                <div style="font-size:18px;font-weight:700">Welcome!</div>
                <div class="small">Upload a photo to preview here.</div>
            </div>
        `;

        document.getElementById("add").innerText ="Add";
    }

</script>
</body>
</html>