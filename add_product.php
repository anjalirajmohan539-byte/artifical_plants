<?php

include('database.php');


$editId = "";
$button = "Add Product";

if (isset($_POST['edit'])) {
    $editId = $_POST['productid'];     
    $button = "Update" ;
}


?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/add_product.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <span class="small" style="color:var(--muted);padding:6px;text-align:center">No image</span>
              </div>

              <div style="flex:1;">
                <input id="productImage" name="image" type="file" aria-describedby="imgHelp">
                <div id="imgHelp" class="small" style="margin-top:6px">Recommended : square image Max 2MB.</div>

                <input type="hidden" name="product" value="<?php echo $editId;?>">
              </div>
            </div>
          </div>

          <!---------------------------------------------------- Product name ---------------------------------------------------->

          <div class="field">
            <label for="productName">Product name <s>*</s></label>
            <input id="productName" name="productName" type="text" placeholder="e.g. Classic White Vase" required >
          </div>

          <!---------------------------------------------------- Product type ---------------------------------------------------->

          <div class="field">
               <?php
          
          $select="SELECT `Id`, `Categorys` FROM `product_category` WHERE IsDeleted = 0";
          $statment=mysqli_query($conn,$select);

          if(mysqli_num_rows($statment)>0)
          {
            
          
          ?>
            <label for="productType">Product type <s>*</s></label>
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
      
          <!---------------------------------------------------- color ------------------------------------------------------>



          <div style="display:flex; gap:15px;">
            <div style="display:flex; flex-direction:column;">
              <label>Color Name</label>
              <input type="text" name="colorName" id="" style="width: 100%;margin-bottom: 10px;">
            </div>
            <div style="display:flex; flex-direction:column;">
              <label>Color Code</label>
              <input type="text" name="colorCode" id="" style="width: 100%;margin-bottom: 10px;">
            </div>
          </div>

          <!---------------------------------------------------- Product price ---------------------------------------------------->

            <div class="field">
            <label for="productPrice">Product price (₹) <s>*</s></label>
            <input id="productPrice" name="productPrice" type="number" min="0" step="0.01" placeholder="e.g. 499.00" required >
          </div>

          <!---------------------------------------------------- material_type ---------------------------------------------------->

          <div class="field">
              <?php
          $select_met="SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted = 0";
          $statemnt=mysqli_query($conn,$select_met);

          if(mysqli_num_rows($statemnt)>0)
          {
          
          ?>
            <label for="productMaterial">Product Materials <s>*</s></label>
            <select name="productMaterial" id="productMaterial">
              <option value="0">Choose Materials</option>
              <?php
              while($material=mysqli_fetch_assoc($statemnt))
              {
              
              ?>
              <option value="<?php echo $material["Id"];?>"><?php echo $material['Name'];?></option>
              <?php }?>
            </select>
            <?php }?>
          </div>



          <!---------------------------------------------------- Product category ---------------------------------------------------->

            <div class="field">
            <label for="materialCategory">Product Category <s>*</s></label>
            <select name="materialCategory" id="materialCategory">
            </select>
          </div>

          <!---------------------------------------------------- Description ---------------------------------------------------->

          <div class="field">
            <label for="productDesc">Description</label>
            <textarea id="productDesc" name="productDesc" placeholder="Short description (optional)"></textarea>
          </div>

          <!---------------------------------------------------- button ---------------------------------------------------->

          <div class="form-actions">
            <button type="submit" id="btn" class="btn" name="btn" style="background-color:#9A8C7A;color:white;">Add product</button>
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
                $select_product="SELECT ap.`Id`, `Price`, `ProductName`, pc.Categorys AS `CategoryId`, ap.`CreateDate` FROM `add_product` ap
                                 INNER JOIN product_category pc ON pc.Id = ap.CategoryId";
                $product_statment=mysqli_query($conn,$select_product);

                $s=1;
                if(mysqli_num_rows($product_statment)>0)
                {
                  while($product=mysqli_fetch_assoc($product_statment))
                  {
                    
                ?>
                <tr>
                  <td class="small" style="color:var(--muted)"><?php echo $s++;?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['ProductName'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['CategoryId'];?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $product['Price'];?></td>
                  <td><a href="product_details.php"><button class="p_view">View</button></a></td>
                  <td><a href="color.php?productId=<?php echo $product['Id'];?>"><button class="p_color">Color</button></a></td>
                  <td><a href="image.php?productId=<?php echo $product['Id'];?>"><button class="p_image">Image</button></a></td>
                  <td>
                  <form action="#" method="post">
                  
                    <input type="hidden" name="productid" value="<?php echo $product['Id'];?>">
                    <input type="submit" name="edit" type="button" class="p_edit" value="Edit">
                    <!-- <a href="#"><button class="p_edit">Edit</button></a> -->
                  
                  </form>
                  </td>
                  <td>
                    <form action="add_product_action.php" method="post">

                    <input type="hidden" name="productid" value="<?php echo $product['Id'];?>">
                    <input type="submit" name="delete" class="p_delete" value="Delete">
                    <!-- <a href="#"><button class="p_delete">Delete</button></a> -->
                    </form>
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
  </div>




  <!---------------------------------------------------- validation ---------------------------------------------------->
  <script>

    const form = document.getElementById('productForm');
    const imgInput = document.getElementById('productImage');
    const imgPreview = document.getElementById('imgPreview');
    const tbody = document.getElementById('productsTbody');
    const resetBtn = document.getElementById('resetBtn');
    const formMsg = document.getElementById('formMsg');

    let products = []; 

    function showImagePreview(file) {
      imgPreview.innerHTML = '';
      if (!file) {
        imgPreview.innerHTML = '<span class="small" style="color:var(--muted);padding:6px;text-align:center">No image</span>';
        return;
      }
      const img = document.createElement('img');
      img.alt = 'product preview';
      imgPreview.appendChild(img);

      const reader = new FileReader();
      reader.onload = e => { img.src = e.target.result; };
      reader.readAsDataURL(file);
    }

    imgInput.addEventListener('change', () => {
      const file = imgInput.files && imgInput.files[0];
      if (file && file.size > 2 * 1024 * 1024) {
        formMsg.textContent = 'Image too large (max 2MB).';
        formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
        imgInput.value = '';
        showImagePreview(null);
        return;
      }
      formMsg.textContent = '';
      showImagePreview(file);
    });

    function renderTable() {

      products.forEach((p, idx) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${idx + 1}</td>
          <td><div class="product-thumb"><img src="${p.image}" alt="${escapeHtml(p.name)}" /></div></td>
          <td>${escapeHtml(p.name)}</td>
          <td class="price">₹ ${Number(p.price).toFixed(2)}</td>
          <td>${escapeHtml(p.desc || '')}</td>
          <td class="small">${escapeHtml(p.type)}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    function escapeHtml(text) {
      if (!text) return '';
      return text.replace(/[&<>"']/g, function (m) {
        return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m];
      });
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      formMsg.textContent = '';

      const name = document.getElementById('productName').value.trim();
      const price = document.getElementById('productPrice').value;
      const type = document.getElementById('productType').value;
      const desc = document.getElementById('productDesc').value.trim();

      if (!imgInput.files || !imgInput.files[0]) {
        formMsg.textContent = 'Please choose a product image.';
        formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
        return;
      }
      if (!name || !price || !type) {
        formMsg.textContent = 'Please fill required fields (name, price, type).';
        formMsg.style.color = getComputedStyle(document.documentElement).getPropertyValue('--danger') || '#dc2626';
        return;
      }


      const file = imgInput.files[0];
      const reader = new FileReader();
      reader.onload = (ev) => {
        const imageDataUrl = ev.target.result;

        products.push({
          image: imageDataUrl,
          name,
          price: Number(price),
          desc,
          material
          type
        });

        renderTable();
        form.reset();
        showImagePreview(null);
        formMsg.textContent = 'Product added (client-side).';
        formMsg.style.color = ''; 
      };
      reader.readAsDataURL(file);
    });

    resetBtn.addEventListener('click', () => {
      form.reset();
      showImagePreview(null);
      formMsg.textContent = '';
    });

 
    renderTable();


  </script>


<!---------------------------------------------------- Ajax js ---------------------------------------------------->


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
</body>
</html