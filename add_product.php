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


  $editselect = "SELECT `ProductImage`, `Price`,`Description`, `ProductName`,`ColorName`, `ColorCode`, `CategoryId`,  `MaterialId`, `MaterialTypeId`,`ProductCount` FROM `add_product` ap
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

              <input type="hidden" name="himage" value="<?php echo empty($prows['ProductImage']) ? "" : $prows['ProductImage'];?>">
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
              <input type="text" name="colorName" id="color" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. White"
                value="<?php echo $prows == "" ? "" : $prows['ColorName'] ?>">
                <div class="error small" id="colorErr"></div>
            </div>
            <div style="display:flex; flex-direction:column;">
              <label>Color Code</label>
              <input type="text" name="colorCode" id="code" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. #fff"
                value="<?php echo $prows == "" ? "" : $prows['ColorCode'] ?>">
                <div class="error small" id="codeErr"></div>
            </div>
          </div>

          <!---------------------------------------------------- Product price ---------------------------------------------------->

          <div style="display: flex; gap: 15px;">
            <div style="display:flex; flex-direction:column;">
            <label for="productPrice">Product price (₹) <s>*</s></label>
            <input id="productPrice" name="productPrice" style="width: 100%;margin-bottom: 10px;" type="number" min="0" step="0.01" placeholder="e.g. 499.00"
              required value="<?php echo $prows == "" ? "" : $prows['Price'] ?>">
            <div class="error small" id="priceErr"></div>
            </div>
          
          <div style="display:flex; flex-direction:column;">
            <label for="productcount">Product Count <s>*</s></label>
            <input id="productcount" name="productcount" style="width: 100%;margin-bottom: 10px;" type="number" placeholder="e.g. 1"
              required value="<?php echo $prows == "" ? "" : $prows['ProductCount'] ?>">
            <div class="error small" id="countErr"></div>
          </div>
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
 <!------- view button ------->     

                      <td><a href="product_details.php?productId=<?php echo $product['Id']; ?>" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a></td>

 <!------- color button ------->

                      <td><a href="color.php?productId=<?php echo $product['Id']; ?>" title="Color"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-palette" viewBox="0 0 16 16">
  <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8m-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7"/>
</svg></a></td>

 <!------- image button ------->

                      <td><a href="image.php?productId=<?php echo $product['Id']; ?>" title="Image"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
</svg></a></td>

<!------- delivery button ------->

<td>
<a href="delivery_details.php?productId=<?php echo $product['Id']; ?>" title="Delivery">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
  <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
</svg>
</a>
</td>

<!------- edit button ------->

                      <td>
                        <form action="#" method="post">

                          <input type="hidden" name="productid" id="hidRowId_<?php echo $Count; ?>"
                            value="<?php echo $product['Id']; ?>">
                          <input type="hidden" name="img" value="<?php echo $product['ProductImage']; ?>">
                          <!-- <input type="submit" name="edit" type="button" class="p_edit" value="Edit"> -->
                          <button type="submit" name="edit" style="border: none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
 </form></td>

 <!------- delete button ------->
 
                      <td>
                        <form action="add_product_action.php" method="post">

                          <input type="hidden" name="productid" value="<?php echo $product['Id']; ?>">

                          <button type="submit" name="delete" style="border: none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                          
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
        document.getElementById("productImage").style.border = "1px solid red";
        valid = false;
    }

    if (name === "") {
        document.getElementById("nameErr").innerText = "Product name required";
        document.getElementById("productName").style.border = "1px solid red";
        valid = false;
    }

    if (type == 0) {
        document.getElementById("typeErr").innerText = "Select type";
        document.getElementById("productType").style.border = "1px solid red";
        valid = false;
    }

    if (price === "" || price <= 0) {
        document.getElementById("priceErr").innerText = "Enter valid price";
        document.getElementById("productPrice").style.border = "1px solid red";
        valid = false;
    }

    if (material == 0) {
        document.getElementById("materialErr").innerText = "Select material";
        document.getElementById("productMaterial").style.border = "1px solid red";
        valid = false;
    }

    if (category == 0 || category === "") {
        document.getElementById("catErr").innerText = "Select category";
        document.getElementById("materialCategory").style.border = "1px solid red";
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

    document.getElementById("productImage").style.border ="";
    document.getElementById("productName").value="";
    document.getElementById("productName").style.border ="";
    document.getElementById("productType").value="0";
    document.getElementById("productType").style.border ="";
    document.getElementById("productPrice").value="";
    document.getElementById("productPrice").style.border ="";
    document.getElementById("productcount").value="";
    document.getElementById("color").value="";
    document.getElementById("code").value="";
    document.getElementById("productMaterial").value="0";
    document.getElementById("productMaterial").style.border ="";
    document.getElementById("materialCategory").value="";
    document.getElementById("materialCategory").style.border ="";
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