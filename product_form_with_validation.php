<?php

include('database.php');


$editId = "";
$button = "Add Product";
$prows = "";

if (isset($_POST['edit']))
{
    $editId = $_POST['productid'];     
    $button = "Update" ;

    $editselect = "SELECT `ProductImage`, `Price`,`Description`, `ProductName`,`ColorName`, `ColorCode`, `CategoryId`,  `MaterialId` FROM `add_product` ap
                   WHERE ap.Id = $editId AND ap.IsDeleted = 0";
                  //  var_dump($editselect);

    $statmnt = mysqli_query($conn,$editselect);

    if(mysqli_num_rows($statmnt)>0)
    {
      $prows = mysqli_fetch_assoc($statmnt);
      
    }
}
// var_dump($prows);
// echo $prows['ProductImage'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Product</title>
    <link href="#" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!---------------------------------------------------- Side Bar ------------------------------------------------------>
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

<!---------------------------------------------------- Main Content ------------------------------------------------------>

    <div class="flex-grow-1">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">

            <!---------------------------------------------------- LEFT: FORM ------------------------------------------------------>

            <div class="container-box">
                <h4>Add Product</h4><hr>
                <form action="#" method="post" id="productForm" enctype="multipart/form-data">
                    <!---------------------------------------------------- Image ------------------------------------------------------>

                    <label class="form-label">Product Image <s>*</s></label>
                    <div class="avatar-preview" id="imagePreview">No Image</div>
                    <input type="file" class="form-control" id="productImage" name="Image" accept="image/*">
                    <div class="error-msg" id="imgError"></div>

                    <!---------------------------------------------------- Product Name ------------------------------------------------------>

                    <label class="form-label mt-3">Product Name <s>*</s></label>
                    <input type="text" name="productName" class="form-control" id="productName" value="<?php echo $prows == '' ? '' : $prows['ProductName'] ?>">
                    <div class="error-msg" id="nameError"></div>

                    <!---------------------------------------------------- Product Type ------------------------------------------------------>

                    <label class="form-label mt-3">Product Type <s>*</s></label>
                    <?php
          $select="SELECT `Id`, `Categorys` FROM `product_category` WHERE IsDeleted = 0";
          $statment=mysqli_query($conn,$select);

          if(mysqli_num_rows($statment)>0)
          {
            
          
          ?>
                    <select class="form-select" id="productType" name="productType">
                        <option value="0">Choose Type</option>
                                      <?php
              while($type=mysqli_fetch_assoc($statment))
              {

              ?>
                        <option value="<?php echo $type["Id"];?>"><?php echo $type['Categorys'];?></option>
                        <?php }?>
                    </select>
                    <?php }?>
                    <div class="error-msg" id="typeError"></div>

                    <!---------------------------------------------------- Price ------------------------------------------------------>

                    <label class="form-label mt-3">Price <s>*</s></label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?php echo $prows == "" ? "" : $prows['Price']?>">
                    <div class="error-msg" id="priceError"></div>

                    <!---------------------------------------------------- color and Code ------------------------------------------------------>

                   <div style="display:flex; gap:15px;">
                    <div style="display:flex; flex-direction:column;">
                        <label>Color Name</label>
                        <input type="text" name="colorName" class="form-control" id="" style="width: 100%;margin-bottom: 10px;" value="<?php echo $prows == "" ? "" : $prows['ColorName']?>">
                    </div>
                    <div style="display:flex; flex-direction:column;">
                        <label>Color Code</label>
                        <input type="text" name="colorCode" class="form-control" id="" style="width: 100%;margin-bottom: 10px;" value="<?php echo $prows == "" ? "" : $prows['ColorCode']?>">
                    </div>
                </div>

          <!---------------------------------------------------- Product Materials ------------------------------------------------------>

                    <label class="form-label mt-3">Product Materials <s>*</s></label>
                    <?php
                    $select_met="SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted = 0";
                    $statemnt=mysqli_query($conn,$select_met);
                    
                    if(mysqli_num_rows($statemnt)>0)
                        {
                            
                            ?>

                    <select class="form-select" id="productMaterials" name="productMaterial">
                        <option value="0">Choose Materials</option>

                        <?php
                        while($material=mysqli_fetch_assoc($statemnt))
                            {
                                
                                ?>
                        <option value="<?php echo $material["Id"];?>"><?php echo $material['Name'];?></option>
                        <?php }?>
                    </select>
                     <?php }?>
                    <div class="error-msg" id="materialError"></div>

                    <!---------------------------------------------------- Product Category ------------------------------------------------------>

                    <label class="form-label mt-3">Product Category <s>*</s></label>
                    <select class="form-select" id="productCategory" name="materialCategory">
                    </select>
                    <div class="error-msg" id="categoryError"></div>

                    <!---------------------------------------------------- Description ------------------------------------------------------>

                    <label class="form-label mt-3">Description</label>
                    <textarea class="form-control" id="description" name="productDesc" rows="3" placeholder="Short description (optional)">
                        <?php echo $prows == "" ? "" : $prows['Description']?></textarea>

                    <!---------------------------------------------------- button ------------------------------------------------------>

                    <button type="button" name="btn" class="btn btn-primary mt-3" id="submitBtn">Add Product</button>
                    <button type="button" id="resetBtn" class="btn secondary">Reset</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">

            <!---------------------------------------------------- RIGHT: TABLE ------------------------------------------------------>
            <div class="container-box">
                <h4>Products List</h4><hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>sl.no</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <?php
                $select_product="SELECT ap.`Id`, `Price`, `ProductName`, pc.Categorys AS `CategoryId`, ap.`CreateDate` FROM `add_product` ap
                                 INNER JOIN product_category pc ON pc.Id = ap.CategoryId WHERE ap.IsDeleted = 0";
                $product_statment=mysqli_query($conn,$select_product);

                $s=1;
                if(mysqli_num_rows($product_statment)>0)
                {
                  while($product=mysqli_fetch_assoc($product_statment))
                  {
                    
                ?>
                        <tr>
                            <td>1</td>
                            <td>ww</td>
                            <td>ee</td>
                            <td>rr</td>
                            <td><a href="product_details.php"><button class="p_view">View</button></a></td>
                            <td><a href="color.php?productId=<?php echo $product['Id'];?>"><button class="p_view">Color</button></a></td>
                            <td><a href="image.php?productId=<?php echo $product['Id'];?>"><button class="p_view">Image</button></a></td>

                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="productid" value="<?php echo $product['Id'];?>">
                                    <input type="submit" name="edit" type="button" class="p_view" value="Edit">
                                </form>
                                <!-- <a href="#"><button class="p_view">Edit</button></a> -->
                            </td>
                            <td>
                                <form action="add_product_action.php" method="post">
                                    <input type="hidden" name="productid" value="<?php echo $product['Id'];?>">
                                    <input type="submit" name="delete" class="p_view" value="Delete">
                                </form>
                                <!-- <a href="#"><button class="p_view">Delete</button></a> -->
                            </td>
                        </tr>
                             <?php   }
                }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!---------------------------------------------------- Validation ------------------------------------------------------>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // IMAGE PREVIEW
    $("#productImage").on("change", function () {
        let file = this.files[0];

        if (file) {
            // Validate file type
            let validTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
            if (!validTypes.includes(file.type)) {
                $("#imgError").text("Only JPG, PNG, WEBP images allowed.");
                $("#imagePreview").html("No Image");
                return;
            }

            // Validate size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                $("#imgError").text("Max image size is 2MB.");
                $("#imagePreview").html("No Image");
                return;
            }

            $("#imgError").text("");

            let reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview")
                    .html(`<img src="${e.target.result}" style="width:100%; height:150px; object-fit:cover; border-radius:8px;">`);
            };
            reader.readAsDataURL(file);
        }
    });


    // FORM VALIDATION
    $("#submitBtn").click(function () {

        let isValid = true;

        // Reset all error messages
        $(".error-msg").text("");

        // Fields
        let image = $("#productImage").val();
        let name = $("#productName").val().trim();
        let type = $("#productType").val();
        let price = $("#productPrice").val();
        let material = $("#productMaterials").val();
        let category = $("#productCategory").val();

        // Image Validation
        if (image === "") {
            $("#imgError").text("Product image is required.");
            isValid = false;
        }

        // Name
        if (name === "") {
            $("#nameError").text("Product name is required.");
            isValid = false;
        }

        // Type
        if (type === "") {
            $("#typeError").text("Please select product type.");
            isValid = false;
        }

        // Price
        if (price === "") {
            $("#priceError").text("Price is required.");
            isValid = false;
        } else if (price <= 0) {
            $("#priceError").text("Price must be greater than 0.");
            isValid = false;
        }

        // Materials
        if (material === "") {
            $("#materialError").text("Select product material.");
            isValid = false;
        }

        // Category
        if (category === "") {
            $("#categoryError").text("Select product category.");
            isValid = false;
        }

        function clearErrors() {
    document.querySelectorAll(".error").forEach(err => err.innerText = "");
    document.querySelectorAll("input, select").forEach(el => el.style.border = "");
}

        document.getElementById("resetBtn").addEventListener("click", function () {
         document.getElementById("productForm").reset();
         clearErrors();
});

        if (!isValid) return;

        // If valid, continue with AJAX submit
        let formData = new FormData($("#productForm")[0]);

        $.ajax({
            url: "add_product_action.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert("Product added successfully!");
                $("#productForm")[0].reset();
                $("#imagePreview").html("No Image");
            }
        });
    });

});
</script>

<!---------------------------------------------------- Ajax ------------------------------------------------------>


<script>
$("#productMaterial").change(function () 
{

    let material = $(this).val();

    $.ajax
    ({
        url: "categoryid.php",
        type: "POST",
        data: 
        { 
        productMaterial: material
        },
        success: function (response)
        {
            $("#materialCategory").html(response);
        }
    });
});
</script>

    </div>
</div>
</body>
</html>
