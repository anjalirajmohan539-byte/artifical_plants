<?php

include('database.php');


$editId = "";
$button = "Add Product";
$prows = "";
$imgs = "";
$category = false;
$categoryType = 0;

if (isset($_POST['edit']) || isset($_GET['productid'])) {
  // echo "<script>alert('hi')</script>";
  $editId = $_POST['productid'] ?? $_GET['productid'];
  // $imgs = $_POST['img'];
  $button = "Update Product";
  $category = true;


  $editselect = "SELECT `ProductImage`, `Price`,`Description`, `ProductName`,`ColorName`, `ColorCode`, `CategoryId`,  `MaterialId`, `MaterialTypeId`,`ProductCount` FROM `add_product` ap
                   WHERE ap.Id = $editId AND ap.IsDeleted = 0";
  $statmnt = mysqli_query($conn, $editselect);

  if (mysqli_num_rows($statmnt) > 0) {
    $prows = mysqli_fetch_assoc($statmnt);

    $imgs = $prows['ProductImage'];
  }
}

?>




<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Product - Milon Artificial Plants </title>
  <link rel="stylesheet" href="css/add_product_origin.css">
  <link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="d-flex">
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

  <!-- Main area -->
  <main class="flex-grow-1">
    <div class="container-fluid container-main">
      <div class="row gx-4">
        <!-- Form column -->
        <div class="col-lg-4">
          <div class="panel-card">
            <h5 class="mb-3">Add Product</h5>

            <form action="#" method="post"  id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">
              <!-- Image preview + input -->
              <label class="form-label">Product image <s>*</s></label>
              <div class="mb-2">
                <div class="avatar-preview" id="imagePreview">No image</div>
                <input class="form-control form-control-sm" type="file" id="productImage" accept="image/*">
                <div class="form-text" style="font-size: 11px !important;">Recommended: square image. Max 2MB.</div>
              </div>

              <!-- Product name -->
              <div class="mb-3">
                <label class="form-label">Product name <s>*</s></label>
                <input type="text" id="productName" class="form-control" placeholder="e.g. Classic White Vase" required>
                <div class="invalid-feedback">Product name is required.</div>
              </div>

              <!-- Product type -->
              <div class="mb-3">
                <?php
            $select = "SELECT `Id`, `Categorys` FROM `product_category` WHERE IsDeleted = 0";
            $statment = mysqli_query($conn, $select);

            if (mysqli_num_rows($statment) > 0) {


              ?>
                <label class="form-label">Product type <s>*</s></label>
                <select class="form-select" id="productType" required>
                  <option value="0">Choose type</option>
                  <?php
                  while ($type = mysqli_fetch_assoc($statment)) {
                  ?>
                  <option value="<?php echo $type['Id'];?>"><?php echo $type['Categorys']?></option>
                  <?php }?>
                </select>
                <?php }?>
                <div class="invalid-feedback">Please choose type.</div>
              </div>

                      <div style="display:flex; gap:50px;">
            <div style="display:flex; flex-direction:column;">
              <label>Color Name <s>*</s></label>
              <input type="text" name="colorName" class="form-control" id="color" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. White">
                <div class="error small" id="colorErr"></div>
            </div>
            <div style="display:flex; flex-direction:column;">
              <label>Color Code <s>*</s></label>
              <input type="text" name="colorCode" class="form-control" id="code" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. #fff">
                <div class="error small" id="codeErr"></div>
            </div>
          </div>

          <!---------------------------------------------------- Product price ---------------------------------------------------->

          <div style="display: flex; gap: 50px;">
            <div style="display:flex; flex-direction:column;">
            <label for="productPrice">Product price (₹) <s>*</s></label>
            <input id="productPrice" class="form-control" name="productPrice" style="width: 100%;margin-bottom: 10px;" type="number" min="0" step="0.01" placeholder="e.g. 499.00">
            <div class="error small" id="priceErr"></div>
            </div>
          
          <div style="display:flex; flex-direction:column;">
            <label for="productcount">Product Count <s>*</s></label>
            <input id="productcount" class="form-control" name="productcount" style="width: 100%;margin-bottom: 10px;" type="number" placeholder="e.g. 1">
            <div class="error small" id="countErr"></div>
          </div>
          </div>

              <!-- Materials select -->
              <div class="mb-3">
                  <?php
            $select_met = "SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted = 0";
            $statemnt = mysqli_query($conn, $select_met);

            if (mysqli_num_rows($statemnt) > 0) {

              ?>
                <label class="form-label">Product Materials <s>*</s></label>
                <select class="form-select" id="productMaterials" required>
                  <option value="0">Choose Materials</option>
                  <?php
                while ($material = mysqli_fetch_assoc($statemnt)) {

                  ?>
                  <option value="<?php echo $material['Id'];?>"><?php echo $material['Name'];?></option>
                  <?php }?>
                </select>
                <?php 
                }?>
                <div class="invalid-feedback">Please choose a material.</div>
              </div>

              <!-- Category select - toggled depending on materials -->
              <div class="mb-3" id="categoryContainer">
                <label class="form-label">Product Category <s>*</s></label>
                <select class="form-select" id="productCategory" required>
                </select>
                <div class="invalid-feedback">Please choose a category.</div>
              </div>

              <!-- Description -->
              <div class="mb-3">
                <label class="form-label">Description <s>*</s></label>
                <textarea id="description" class="form-control" rows="4" placeholder="Short description (optional)"></textarea>
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-brown">Add product</button>
                <button type="button" id="resetBtn" class="btn btn-outline-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Right column: product list + main image -->
        <div class="col-lg-8">
          <div class="panel-card mb-3">
            <h5>Products list</h5>
            <div class="table-responsive">
              <table class="table table-sm align-middle">
                <thead>
                  <tr>
                    <th>Sl no</th>
                    <th>Product name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="productsTable">
                  <!-- sample rows -->
                  <tr>
                    <td>1</td>
                    <td>plant</td>
                    <td>Artificial Plants</td>
                    <td>325.00</td>
                    <td>
                      <button class="btn btn-sm btn-outline-secondary">View</button>
                      <button class="btn btn-sm btn-brown">Image</button>
                      <button class="btn btn-sm btn-brown">Color</button>
                      <button class="btn btn-sm btn-outline-primary">Edit</button>
                      <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>vase</td>
                    <td>Vases</td>
                    <td>499.00</td>
                    <td>
                      <button class="btn btn-sm btn-outline-secondary">View</button>
                      <button class="btn btn-sm btn-brown">Image</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="panel-card">
            <h6>Preview (main image)</h6>
            <img id="mainImage" class="main-img" src="" alt="Main product preview">
            <div class="mt-2 text-muted small">Click a thumbnail to swap the main image.</div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
const productImageInput = document.getElementById('productImage');
const imagePreview = document.getElementById('imagePreview');
const galleryThumbs = document.getElementById('galleryThumbs');
const mainImage = document.getElementById('mainImage');

let galleryImages = []; 


productImageInput.addEventListener('change', (e) => {
  const file = e.target.files[0];
  if(!file) return;

  
  if(file.size > 2 * 1024 * 1024){
    alert('Image size exceeds 2MB. Please pick a smaller file.');
    e.target.value = '';
    return;
  }

  const reader = new FileReader();
  reader.onload = function(ev){
    const dataUrl = ev.target.result;
 
    imagePreview.innerHTML = '';
    const img = document.createElement('img');
    img.src = dataUrl;
    imagePreview.appendChild(img);


    mainImage.src = dataUrl;

  };
  reader.readAsDataURL(file);
});

function addToGallery(dataUrl){

  galleryImages.unshift(dataUrl);
 
}

function renderGallery(){
  galleryImages.forEach((src, idx) => {
    const img = document.createElement('img');
    img.src = src;
    img.alt = 'thumb-' + idx;
    img.addEventListener('click', () => swap(img));
    galleryThumbs.appendChild(img);
  });
  if(galleryImages.length > 0) mainImage.src = galleryImages[0];
}


function swap(imgElement){
  const clickedSrc = imgElement.src;

  mainImage.src = clickedSrc;

  document.querySelectorAll('.thumbs img').forEach(i=> i.style.borderColor = 'transparent');
  imgElement.style.borderColor = getComputedStyle(document.documentElement).getPropertyValue('--accent') || '#b38f80';
}

const resetBtn = document.getElementById('resetBtn');
const productMaterials = document.getElementById('productMaterials');
const categoryContainer = document.getElementById('categoryContainer');


resetBtn.addEventListener('click', () => {

  document.getElementById('productForm').reset();


  imagePreview.innerHTML = 'No image';
  galleryImages = [];



  document.querySelectorAll('#productForm .is-invalid, #productForm .is-valid').forEach(el=>{
    el.classList.remove('is-invalid','is-valid');
  });
});


const form = document.getElementById('productForm');

form.addEventListener('submit', (e) => {
  e.preventDefault();


  const inputs = form.querySelectorAll('[required]');
  let formValid = true;

  inputs.forEach(input => {
    
    if((input.tagName === 'INPUT' || input.tagName === 'TEXTAREA') && input.value.trim() === ''){
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      formValid = false;
    } else if(input.tagName === 'SELECT' && input.value === ''){
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      formValid = false;
    } else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
    }

   
    if(input.id === 'productPrice'){
      const v = parseFloat(input.value);
      if(isNaN(v) || v < 0){
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        formValid = false;
      }
    }
  });

  
  if(mainImage.src.includes('placeholder') || imagePreview.innerHTML.trim() === 'No image'){
  
    productImageInput.classList.add('is-invalid');
    formValid = false;
  } else {
    productImageInput.classList.remove('is-invalid');
    productImageInput.classList.add('is-valid');
  }

  if(!formValid){
    
    const firstError = form.querySelector('.is-invalid');
    if(firstError){
      firstError.scrollIntoView({behavior:'smooth', block:'center'});
    }
    return;
  }

  
  addProductToTable({
    name: document.getElementById('productName').value.trim(),
    type: document.getElementById('productType').value,
    price: parseFloat(document.getElementById('productPrice').value).toFixed(2),
    image: mainImage.src || ''
  });

});

function addProductToTable({name, type, price, image}){
  const table = document.getElementById('productsTable');
  const row = document.createElement('tr');
  const idx = table.rows.length + 1;
  row.innerHTML = `
    <td>${idx}</td>
    <td>${escapeHtml(name)}</td>
    <td>${escapeHtml(type)}</td>
    <td>${escapeHtml(price)}</td>
    <td>
      <button class="btn btn-sm btn-outline-secondary">View</button>
      <button class="btn btn-sm btn-brown" onclick='viewImage("${image.replace(/"/g,"'")}")'>Image</button>
    </td>
  `;
  table.appendChild(row);
}


function viewImage(src){
  if(!src) return;
  window.open(src, '_blank');
}


function escapeHtml(unsafe) {
  return unsafe
    .replaceAll('&','&amp;')
    .replaceAll('<','&lt;')
    .replaceAll('>','&gt;')
    .replaceAll('"','&quot;')
    .replaceAll("'",'&#039;');
}



</script>

<script>
document.getElementById("resetBtn").addEventListener("click", function () {

  const form = document.getElementById("productForm");

  form.reset();

  form.classList.remove("was-validated");

  form.querySelectorAll(".is-invalid, .is-valid").forEach(el => {
    el.classList.remove("is-invalid", "is-valid");
  });

  document.getElementById("imagePreview").innerHTML = "No image";
  document.getElementById("mainImage").innerText = "";

});
</script>


<script>
    let category = <?php echo $prows != "" ? $prows['MaterialTypeId'] : '0' ?>;
    // alert(category);
    <?php
    if ($category) {
      ?>
      categoryedit();

      $(document).ready(function () {
        let id = document.getElementById("productCategory");

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
            productMaterials: material
          },
          success: function (response) {
            $("#productCategory").html(response);

            if(category != "")
            {
              $("#productCategory").val(category);
            }
          }
        });
    };



  </script>

</body>
</html>