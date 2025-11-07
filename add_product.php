<?php

include('database.php');

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/add_product.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="sidebar">
    <h2>Milon <br> Artifical Plants</h2>
    <ul>
	<a href="admin_page.php"><li><img src="images/dashboard_icon.jpg">Dashboard</li></a>
	<a href="#"><li><img src="images/product_icon.jpg">Orders</li></a>
    <a href="#"><li><img src="images/users_icon.jpg">User List</li></a>
    <a href="add_product.php"><li><img src="images/add-product.png">Add Product</li></a>
    <a href="#"><li><img src="images/product_icon.jpg">Product List</li></a>
    <a href="#"><li><img src="images/report_icon.jpg">Report</li></a>
    <a href="index.php"><li><img src="images/logout_icon.jpg">Logout</li></a>
    </ul>
  </div>

  <!-- main content -->

  <div class="container" role="main">
    <div class="header">
      <div>
        <h1>Add Product</h1>
        <p class="small">Create a new product with image, price and type</p>
      </div>
      <div class="hint">Fields marked required *</div>
    </div>

    <div class="layout">
      <!-- LEFT: FORM -->
      <div class="card" aria-labelledby="form-title">
        <h2 id="form-title" style="margin:0 0 12px 0;font-size:15px;">Product details</h2>

        <form action="add_product_action.php" method="post" id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">
          <div class="field">
            <label for="productImage">Product image *</label>
            <div class="file-input">
              <div class="file-preview" id="imgPreview" title="Image preview">
                <span class="small" style="color:var(--muted);padding:6px;text-align:center">No image</span>
              </div>

              <div style="flex:1;">
                <input id="productImage" name="image" type="file" aria-describedby="imgHelp">
                <div id="imgHelp" class="small" style="margin-top:6px">Recommended : square image Max 2MB.</div>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="productName">Product name *</label>
            <input id="productName" name="productName" type="text" placeholder="e.g. Classic White Vase" required >
          </div>

          <div class="field">
            <label for="productPrice">Product price (₹) *</label>
            <input id="productPrice" name="productPrice" type="number" min="0" step="0.01" placeholder="e.g. 499.00" required >
          </div>

       
          <div class="field">
               <?php
          
          $select="SELECT `Id`, `Categorys` FROM `product_category`";
          $statment=mysqli_query($conn,$select);

          if(mysqli_num_rows($statment)>0)
          {
            
          
          ?>
            <label for="productType">Product type *</label>
            <select id="productType" name="productType" required>
              <option value="0">Choose type</option>
              <?php
              while($type=mysqli_fetch_assoc($statment))
              {

              ?>
              <option value="<?php echo $type["Id"];?>"><?php echo $type['Categorys'];?></option>
              <?php }?>
            </select>
            <?php }?>
          </div>

          <div class="field">
            <label for="productDesc">Description</label>
            <textarea id="productDesc" name="productDesc" placeholder="Short description (optional)"></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn" name="btn">Add product</button>
            <button type="button" id="resetBtn" class="btn secondary">Reset</button>
            <div style="margin-left:auto" class="small" id="formMsg" aria-live="polite"></div>
          </div>
        </form>
      </div>

      <!-- RIGHT: TABLE -->
      <div class="table-wrap">
        <div class="card" style="padding:12px 16px;">
          <h3 style="margin:0 0 12px 0;font-size:15px;">Products list</h3>
          <div style="overflow:auto;">
            <table aria-describedby="productsDesc">
              <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Image</th>
                  <th>Product name</th>
                  <th>Price</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="productsTbody">
                
                       <?php
                $select_product="SELECT `Id`, `ProductImage`, `ProductName`, `Description`, `Price`, `CategoryId`, `CreateDate`, `LastUpdated`, `IsDeleted` FROM `add_product`";
                $product_statment=mysqli_query($conn,$select_product);

                $s=1;
                if(mysqli_num_rows($product_statment)>0)
                {
                  while($product=mysqli_fetch_assoc($product_statment))
                  {
                    
                ?>
                <tr>
                  <td class="small" style="color:var(--muted)"><?php echo $s++;?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['ProductImage'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['ProductName'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['Price'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['CategoryId'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['Description'];?></td>
                  <td><button class="p_details">Details</button></td>
                  </tr>

                  <?php   }
                }?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>

    // const form = document.getElementById('productForm');
    // const imgInput = document.getElementById('productImage');
    // const imgPreview = document.getElementById('imgPreview');
    // const tbody = document.getElementById('productsTbody');
    // const resetBtn = document.getElementById('resetBtn');
    // const formMsg = document.getElementById('formMsg');

    // let products = []; 

    // function showImagePreview(file) {
    //   imgPreview.innerHTML = '';
    //   if (!file) {
    //     imgPreview.innerHTML = '<span class="small" style="color:var(--muted);padding:6px;text-align:center">No image</span>';
    //     return;
    //   }
    //   const img = document.createElement('img');
    //   img.alt = 'product preview';
    //   imgPreview.appendChild(img);

    //   const reader = new FileReader();
    //   reader.onload = e => { img.src = e.target.result; };
    //   reader.readAsDataURL(file);
    // }

    // imgInput.addEventListener('change', () => {
    //   const file = imgInput.files && imgInput.files[0];
    //   if (file && file.size > 2 * 1024 * 1024) {
    //     formMsg.textContent = 'Image too large (max 2MB).';
    //     formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
    //     imgInput.value = '';
    //     showImagePreview(null);
    //     return;
    //   }
    //   formMsg.textContent = '';
    //   showImagePreview(file);
    // });

    // function renderTable() {
    //   tbody.innerHTML = '';
    //   if (products.length === 0) {
    //     const tr = document.createElement('tr');
    //     tr.innerHTML = '<td colspan="6" class="small" style="padding:18px 10px;color:var(--muted)">No products added yet.</td>';
    //     tbody.appendChild(tr);
    //     return;
    //   }
    //   products.forEach((p, idx) => {
    //     const tr = document.createElement('tr');
    //     tr.innerHTML = `
    //       <td>${idx + 1}</td>
    //       <td><div class="product-thumb"><img src="${p.image}" alt="${escapeHtml(p.name)}" /></div></td>
    //       <td>${escapeHtml(p.name)}</td>
    //       <td class="price">₹ ${Number(p.price).toFixed(2)}</td>
    //       <td>${escapeHtml(p.desc || '')}</td>
    //       <td class="small">${escapeHtml(p.type)}</td>
    //     `;
    //     tbody.appendChild(tr);
    //   });
    // }

    // function escapeHtml(text) {
    //   if (!text) return '';
    //   return text.replace(/[&<>"']/g, function (m) {
    //     return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m];
    //   });
    // }

    // form.addEventListener('submit', async (e) => {
    //   e.preventDefault();
    //   formMsg.textContent = '';

    //   const name = document.getElementById('productName').value.trim();
    //   const price = document.getElementById('productPrice').value;
    //   const type = document.getElementById('productType').value;
    //   const desc = document.getElementById('productDesc').value.trim();

    //   if (!imgInput.files || !imgInput.files[0]) {
    //     formMsg.textContent = 'Please choose a product image.';
    //     formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
    //     return;
    //   }
    //   if (!name || !price || !type) {
    //     formMsg.textContent = 'Please fill required fields (name, price, type).';
    //     formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
    //     return;
    //   }


    //   const file = imgInput.files[0];
    //   const reader = new FileReader();
    //   reader.onload = (ev) => {
    //     const imageDataUrl = ev.target.result;

    //     products.push({
    //       image: imageDataUrl,
    //       name,
    //       price: Number(price),
    //       desc,
    //       type
    //     });

    //     renderTable();
    //     form.reset();
    //     showImagePreview(null);
    //     formMsg.textContent = 'Product added (client-side).';
    //     formMsg.style.color = ''; 
    //   };
    //   reader.readAsDataURL(file);
    // });

    // resetBtn.addEventListener('click', () => {
    //   form.reset();
    //   showImagePreview(null);
    //   formMsg.textContent = '';
    // });

 
    // renderTable();
  </script>
</body>
</html