<?php

include('database.php');

$pId = $_GET['productId'];

$button = "Save";
$pairId = "";
$image = "";

if(isset($_POST['edit']))
{
    $button = "Update";
    $pairId = $_POST['id'];
    $image = $_POST['img'];
}


?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_pair.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
        <!-- SIDEBAR -->
<?php

include('sidebar.php');
?>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Product Pair Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add Product Pair</h3>
            <form action="product_pair_action.php" method="post" id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">

            <label>Image<s>*</s></label>
            <input type="file" id="Image" name="Image" accept="image/*" oninput="clearError('imageErr')">
            <div class="error" id="imageErr"></div>

            <label>Name<s>*</s></label>
            <input type="text" id="Name" name="Name" placeholder="Enter pair name" oninput="clearError('nameErr')">
            <input type="hidden" name="product_Id" id="product_Id" value="<?php echo $pId;?>">
            <div class="error" id="nameErr"></div>

            <label style="margin-right: 10%;">Price<s>*</s></label>
            <input type="text" id="Price" name="Price" placeholder="Enter price" oninput="clearError('priceErr')">
            <div class="error" id="priceErr"></div>

            <label>Description<s>*</s></label>
            <textarea name="Description" id="Description" oninput="clearError('descErr')"></textarea>
            <div class="error" id="descErr"></div>

            <button class="btn btn-save" name="btn" onclick="return validateForm()">Save</button>
            <button class="btn btn-reset" type="button" onclick="resetForm()">Reset</button>

            </form>
        </div>

        
       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $select = "SELECT pp.`Id`, ap.ProductName AS `ProductId`, `Image`, `Name`, pp.`Price` FROM `product_pair` pp
                           INNER JOIN add_product ap ON ap.Id = pp.ProductId
                           WHERE ProductId = $pId AND pp.`IsDeleted` = 0";
                $check = mysqli_query($conn,$select);
                // var_dump($select);

                $sl = 1;
                if(mysqli_num_rows($check)>0)
                {
                    while($pair = mysqli_fetch_assoc($check))
                    {

                
                ?>
            <tr>
                    <td><?php echo $sl++;?></td>
                    <td><img src="images/pair/<?php echo $pair['Image'];?>" alt="" style="width: 100px;"></td>
                    <td><?php echo $pair['ProductId'];?></td>
                    <td><?php echo $pair['Name']?></td>
                    <td>₹<?php echo $pair['Price']?></td>
                    <td>
                        <form action="product_pair_action.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $pair['Id'];?>">
                            <input type="hidden" name="img" value="<?php echo $pair['Image'];?>">
                            <button type="submit" name="edit" style="border:none;background: transparent;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
                       </form> 
                    </td>
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="id" value="<?php echo $pair['Id'];?>">
                            <input type="hidden" name="pid" value="<?php echo $pId;?>">
                            <button type="submit" name="delete" style="border:none;background: transparent;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
</form>
                    </td>
                    </tr>
                    <?php     }
                }?>
            </table>
        </div>

    </div>
</div>

<script>
function validateForm() {
    let valid = true;

    let image = document.getElementById("Image").files.length;
    let name = document.getElementById("Name").value.trim();
    let price = document.getElementById("Price").value.trim();
    let desc = document.getElementById("Description").value.trim();

    if (image === 0) {
        showError("imageErr", "Please select an image");
        valid = false;
    }

    if (name === "") {
        showError("nameErr", "Pair name is required");
        valid = false;
    }

    if (price === "") {
        showError("priceErr", "Price is required");
        valid = false;
    } else if (isNaN(price) || price <= 0) {
        showError("priceErr", "Enter a valid price");
        valid = false;
    }

    if (desc === "") {
        showError("descErr", "Description is required");
        valid = false;
    }

    return valid;
}

function showError(id, message) {
    document.getElementById(id).innerText = message;
}

function clearError(id) {
    document.getElementById(id).innerText = "";
}

function resetForm() {
    document.getElementById("productForm").reset();
    document.querySelectorAll(".error").forEach(e => e.innerText = "");
}
</script>

</body>
</html>