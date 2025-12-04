<?php

include('database.php');


$editId = "";
$button = "Add Product";
$prows = "";
$imgs = "";
$category = false;
$categoryType = 0;

if (isset($_POST['edit'])) {
  $editId = $_POST['productid'];
  $imgs = $_POST['img'];
  $button = "Update Product";
  $category = true;


  $editselect = "SELECT `ProductImage`, `Price`,`Description`, `ProductName`,`ColorName`, `ColorCode`, `CategoryId`,  `MaterialId`, `MaterialTypeId` FROM `add_product` ap
                   WHERE ap.Id = $editId AND ap.IsDeleted = 0";
  $statmnt = mysqli_query($conn, $editselect);

  if (mysqli_num_rows($statmnt) > 0) {
    $prows = mysqli_fetch_assoc($statmnt);

  }
}



?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Artifical_plant_registration</title>
  <link href="css/add_product.css" rel="stylesheet">
  <link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="js/jquery.min"></script>
</head>

<body>

  <div class="sidebar">
    <h2>Milon <br> Artifical Plants</h2>
    <ul>
      <li><a href="admin_page.php"><img src="images/dashboard_icon.jpg">Dashboard</a></li>
      <li><a href="#"><img src="images/product_icon.jpg">Orders</a></li>
      <li><a href="#"><img src="images/users_icon.jpg">User List</a></li>
      <li><a href="add_product.php"><img src="images/add-product.png">Add Product</a></li>
      <li><a href="#"><img src="images/product_list.jpg">Product List</a></li>
      <li> <a href="product_material.php"><img src="images/product_list.jpg">Product Materials</a></li>
      <li><a href="#"><img src="images/report_icon.jpg">Report</a></li>
      <li><a href="index.php"><img src="images/logout_icon.jpg">Logout</a></li>
    </ul>
  </div>

  <!---------------------------------------------------- main content ---------------------------------------------------->

  <div class="container" role="main">
    <div class="header">
      <div>
        <h1>Add Product</h1>
        <p class="small">Create a new product with image, price and type</p>
      </div>
    </div>

    <div class="layout">
      <!---------------------------------------------------- LEFT: FORM ---------------------------------------------------->
      <div class="card" aria-labelledby="form-title">
        <h2 id="form-title" style="margin:0 0 12px 0;font-size:15px;">Product details</h2>


        <!---------------------------------------------------- Product image ---------------------------------------------------->

        <form action="add_product_action.php" method="post" id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">
          <div class="field">
            <label for="productImage">Product image <s>*</s></label>
            <div class="file-input">
              <div class="file-preview" id="imgPreview" title="Image preview">
                <span class="small"
                  style="color:var(--muted);padding:6px;text-align:center;<?php echo $imgs != "" ? 'display:none' : '' ?>">No
                  image</span>
                <?php
                if ($imgs != '') {
                  ?>
                  <img src="images/product/<?php echo $imgs; ?>" alt="">
                <?php } ?>
              </div>

              <div style="flex:1;">
                <input id="productImage" name="image" type="file" aria-describedby="imgHelp">
                <div class="error small" id="imgErr"></div>
                <div id="imgHelp" class="small" style="margin-top:6px">Recommended : square image Max 2MB.</div>

                <input type="hidden" id="productId" name="product" value="<?php echo $editId; ?>">
              </div>
            </div>
          </div>

          <!---------------------------------------------------- Product name ---------------------------------------------------->


          <div class="field">
            <label for="productName">Product name <s>*</s></label>
            <input id="productName" name="productName" type="text" placeholder="e.g. Classic White Vase"
              value="<?php echo $prows == '' ? '' : $prows['ProductName'] ?>" required>
          </div>
          <div class="error small" id="nameErr"></div>

          <!---------------------------------------------------- Product type ---------------------------------------------------->

          <div class="field">
            <?php
            $select = "SELECT `Id`, `Categorys` FROM `product_category` WHERE IsDeleted = 0";
            $statment = mysqli_query($conn, $select);

            if (mysqli_num_rows($statment) > 0) {


              ?>
              <label for="productType">Product type <s>*</s></label>
              <select id="productType" name="productType" required>
                <option value="0">Choose type</option>
                <?php
                while ($type = mysqli_fetch_assoc($statment)) {

                  ?>
                  <option value="<?php echo $type["Id"]; ?>" <?php echo ($prows != "" && $type['Id'] == $prows['CategoryId']) ? 'selected' : ''; ?>><?php echo $type['Categorys']; ?></option>
                <?php } ?>
              </select>
              <div class="error small" id="typeErr"></div>
            <?php } ?>
          </div>

          <!---------------------------------------------------- color ------------------------------------------------------>



          <div style="display:flex; gap:15px;">
            <div style="display:flex; flex-direction:column;">
              <label>Color Name</label>
              <input type="text" name="colorName" id="color" style="width: 100%;margin-bottom: 10px;"
                value="<?php echo $prows == "" ? "" : $prows['ColorName'] ?>">
                <div class="error small" id="colorErr"></div>
            </div>
            <div style="display:flex; flex-direction:column;">
              <label>Color Code</label>
              <input type="text" name="colorCode" id="code" style="width: 100%;margin-bottom: 10px;"
                value="<?php echo $prows == "" ? "" : $prows['ColorCode'] ?>">
                <div class="error small" id="codeErr"></div>
            </div>
          </div>

          <!---------------------------------------------------- Product price ---------------------------------------------------->

          <div class="field">
            <label for="productPrice">Product price (₹) <s>*</s></label>
            <input id="productPrice" name="productPrice" type="number" min="0" step="0.01" placeholder="e.g. 499.00"
              required value="<?php echo $prows == "" ? "" : $prows['Price'] ?>">
            <div class="error small" id="priceErr"></div>
          </div>


          <!---------------------------------------------------- material_type ---------------------------------------------------->

          <div class="field">
            <?php
            $select_met = "SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted = 0";
            $statemnt = mysqli_query($conn, $select_met);

            if (mysqli_num_rows($statemnt) > 0) {

              ?>
              <label for="productMaterial">Product Materials <s>*</s></label>
              <select name="productMaterial" id="productMaterial" onchange="categoryedit()">
                <option value="0">Choose Materials</option>
                <?php
                while ($material = mysqli_fetch_assoc($statemnt)) {

                  ?>
                  <option value="<?php echo $material["Id"]; ?>" <?php echo ($prows != "" && $material['Id'] == $prows['MaterialId']) ? 'selected' : '' ?>>
                    <?php echo $material['Name']; ?></option>
                <?php } ?>
              </select>
              <div class="error small" id="materialErr"></div>
            <?php } ?>
          </div>



          <!---------------------------------------------------- Product category ---------------------------------------------------->

          <div class="field" id="category">
            <label for="materialCategory">Product Category <s>*</s></label>
            <select name="materialCategory" id="materialCategory">
            </select>
            <div class="error small" id="catErr"></div>
          </div>

          <!---------------------------------------------------- Description ---------------------------------------------------->

          <div class="field">
            <label for="productDesc">Description</label>
            <textarea id="productDesc" name="productDesc"
              placeholder="Short description (optional)"><?php echo $prows == "" ? "" : $prows['Description'] ?></textarea>
          </div>

          <!---------------------------------------------------- button ---------------------------------------------------->

          <div class="form-actions">
            <button type="submit" id="btn" class="btn" name="btn" style="background-color:#9A8C7A;color:white;"
              onsubmit="ValidationForm()"><?php echo $button; ?></button>




            <button type="button" id="resetBtn" class="btn secondary">Reset</button>
            <div style="margin-left:auto" class="small" id="formMsg" aria-live="polite"></div>
          </div>
        </form>
      </div>

      <!---------------------------------------------------- RIGHT: TABLE ---------------------------------------------------->
      <div class="table-wrap">
        <div class="card" style="padding:12px 16px;">
          <h3 style="margin:0 0 12px 0;font-size:15px;">Products list</h3>
          <div style="overflow:auto;">
            <table aria-describedby="productsDesc">
              <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Product name</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="productsTbody">

                <?php
                $select_product = "SELECT ap.`Id`,`ProductImage`, `Price`, `ProductName`, pc.Categorys AS `CategoryId`, ap.`CreateDate` FROM `add_product` ap
                                 INNER JOIN product_category pc ON pc.Id = ap.CategoryId WHERE ap.IsDeleted = 0";
                $product_statment = mysqli_query($conn, $select_product);

                $s = 1;
                if (mysqli_num_rows($product_statment) > 0) {
                  $Count = 1;
                  while ($product = mysqli_fetch_assoc($product_statment)) {

                    ?>
                    <tr>
                      <td class="small" style="color:var(--muted)"><?php echo $s++; ?></td>
                      <td class="small" style="color:var(--muted)"><?php echo $product['ProductName']; ?></td>
                      <td class="small" style="color:var(--muted)"><?php echo $product['CategoryId']; ?></td>
                      <td class="small" style="color:var(--muted)"><?php echo $product['Price']; ?></td>
                      <td><a href="product_details.php?productId=<?php echo $product['Id']; ?>"><button
                            class="p_view">View</button></a></td>
                      <td><a href="color.php?productId=<?php echo $product['Id']; ?>"><button
                            class="p_color">Color</button></a></td>
                      <td><a href="image.php?productId=<?php echo $product['Id']; ?>"><button
                            class="p_image">Image</button></a></td>
                      <td>
                        <form action="#" method="post">

                          <input type="hidden" name="productid" id="hidRowId_<?php echo $Count; ?>"
                            value="<?php echo $product['Id']; ?>">
                          <input type="hidden" name="img" value="<?php echo $product['ProductImage']; ?>">
                          <input type="submit" name="edit" type="button" class="p_edit" value="Edit">
                          <!-- <a href="#"><button class="p_edit">Edit</button></a> -->

                        </form>
                      </td>
                      <td>
                        <form action="add_product_action.php" method="post">

                          <input type="hidden" name="productid" value="<?php echo $product['Id']; ?>">
                          <input type="submit" name="delete" class="p_delete" value="Delete">
                          <!-- <a href="#"><button class="p_delete">Delete</button></a> -->
                        </form>
                      </td>
                    </tr>

                    <?php
                    $Count++;
                  }
                } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!---------------------------------------------------- Form validation ---------------------------------------------------->


<script>

document.getElementById("productImage").addEventListener("change", function () {
    const file = this.files[0];
    const preview = document.getElementById("imgPreview");

    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            document.getElementById("imgErr").innerText = "Max size allowed is 2MB.";
            this.value = "";
            preview.innerHTML = "<span class='small' style='color:gray;padding:6px;'>No image</span>";
            return;
        }

        const reader = new FileReader();
        reader.onload = function () {
            preview.innerHTML = `<img src="${this.result}" 
                                  style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = "<span class='small' style='color:gray;padding:6px;'>No image</span>";
    }
});



function ValidationForm() {
    let valid = true;

    let image = document.getElementById("productImage").value;
    let name = document.getElementById("productName").value.trim();
    let type = document.getElementById("productType").value;
    let price = document.getElementById("productPrice").value;
    let material = document.getElementById("productMaterial").value;
    let category = document.getElementById("materialCategory").value;

    
    document.querySelectorAll(".error").forEach(e => e.innerText = "");

    
    let isEdit = "<?php echo $editId; ?>";

    if (image === "" && isEdit === "") {
        document.getElementById("imgErr").innerText = "Please upload image";
        valid = false;
    }

    if (name === "") {
        document.getElementById("nameErr").innerText = "Product name required";
        valid = false;
    }

    if (type == 0) {
        document.getElementById("typeErr").innerText = "Select type";
        valid = false;
    }

    if (price === "" || price <= 0) {
        document.getElementById("priceErr").innerText = "Enter valid price";
        valid = false;
    }

    if (material == 0) {
        document.getElementById("materialErr").innerText = "Select material";
        valid = false;
    }

    if (category == 0 || category === "") {
        document.getElementById("catErr").innerText = "Select category";
        valid = false;
    }

    return valid;
}



document.getElementById("productForm").addEventListener("submit", function (e) {
    if (!ValidationForm()) {
        e.preventDefault();
    }
});



document.getElementById("resetBtn").addEventListener("click", function () {

    document.getElementById("productName").value="";
    document.getElementById("productType").value="0";
    document.getElementById("productPrice").value="";
    document.getElementById("color").value="";
    document.getElementById("code").value="";
    document.getElementById("productMaterial").value="0";
    document.getElementById("materialCategory").value="";
    document.getElementById("productDesc").value="";
    document.getElementById("productId").value="";
    document.getElementById("btn").innerText="Add Product";


 
    document.getElementById("imgPreview").innerHTML =
        "<span class='small' style='color:gray;padding:6px;'>No image</span>";


    document.querySelectorAll(".error").forEach(e => e.innerText = "");


});

</script>


<script>

function toggleCategoryDropdown() {
    let material = document.getElementById("productMaterial");
    let categoryField = document.getElementById("category");

    if (material.value == "0") {
        categoryField.style.display = "none"; 
        document.getElementById("materialCategory").innerHTML = ""; 
    } else {
        categoryField.style.display = "flex"; 
        loadCategoryOptions(material.value);  
    }
}

document.getElementById("productMaterial").addEventListener("change", function () {
    toggleCategoryDropdown();
});

document.getElementById("resetBtn").addEventListener("click", function () {

    document.getElementById("productMaterial").value = "0";

    document.getElementById("category").style.display = "none";

    document.getElementById("materialCategory").innerHTML = "";
});

window.onload = function () {
    toggleCategoryDropdown();
};

</script>



  <!---------------------------------------------------- Ajax js ---------------------------------------------------->


  <script>
    let category = <?php echo $prows != "" ? $prows['MaterialTypeId'] : '0' ?>;
    // alert(category);
    <?php
    if ($category) {
      ?>
      categoryedit();

      $(document).ready(function () {
        let id = document.getElementById("materialCategory");

        // alert(id.value);
      });

      <?php
    }
    ?>

    function categoryedit() {
      let material = $('#productMaterial').val();

      $.ajax
        ({
          url: "categoryid.php",
          type: "POST",
          data:
          {
            productMaterial: material
          },
          success: function (response) {
            $("#materialCategory").html(response);

            if(category != "")
            {
              $("#materialCategory").val(category);
            }
          }
        });
    };



  </script>

</body>

</html