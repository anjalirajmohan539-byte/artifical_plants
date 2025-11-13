<?php

include('database.php');

$id=$_GET['matId'];

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/material_category.css" rel="stylesheet">
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
    <a href="#"><li><img src="images/product_list.jpg">Product List</li></a>
    <a href="#"><li><img src="images/report_icon.jpg">Report</li></a>
    <a href="index.php"><li><img src="images/logout_icon.jpg">Logout</li></a>
    </ul>
  </div>

      <div class="container" role="main">
    <div class="header">
      <div>
        <h1>Materials Categorys</h1>
      </div>
    </div>

    <div class="layout">

      <!-- LEFT: FORM -->
      <div class="card" aria-labelledby="form-title">
        <h2 id="form-title" style="margin:0 0 12px 0;font-size:15px;">Categorys Details</h2>

        <form action="material_category_action.php" method="post" id="productForm" autocomplete="off" novalidate >

            <div class="field">
            <label for="productType">Material Categorys<s>*</s></label>
            <input id="productType" name="productType" type="text" placeholder="eg.PVC"  required >
          </div>

          <div class="form-actions">
            <button type="submit" class="btn" name="btn" style="background-color:#9A8C7A;color:white;">Add Categorys</button>
            <button type="button" id="resetBtn" class="btn secondary">Reset</button>
            <div style="margin-left:auto" class="small" id="formMsg" aria-live="polite"></div>
          </div>
        </form>
      </div>



      <!-- RIGHT: TABLE -->
      <div class="table-wrap">
        <div class="card" style="padding:12px 16px;">
          <h3 style="margin:0 0 12px 0;font-size:15px;">Material List</h3>
          <div style="overflow:auto;">
            <table aria-describedby="productsDesc">
              <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Material Categorys</th>
                  <th>Material Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody id="productsTbody">
                <?php
                $select="SELECT mc.`Id`, mc.`Name`,mt.Name AS `Type`, mc.`IsDelete` FROM `material_category` mc
                         INNER JOIN material_type mt ON mt.Id = mc.Type WHERE Id=$id";
                $statenmt=mysqli_query($conn,$select); 

                if(mysqli_num_rows($statenmt)>0)
                {
                    $category=mysqli_fetch_assoc($statenmt);
                    
               
                ?>
                <tr>
                  <td class="small" style="color:var(--muted)"></td>
                  <td class="small" style="color:var(--muted)"><?php echo $category['Name']?></td>
                  <td class="small" style="color:var(--muted)"><?php echo $category['Type']?></td>
                  <td class="small" style="color:var(--muted)"><a href="#"><button>Edit</button></a></td>
                  <td class="small" style="color:var(--muted)"><a href="#"><button>Delete</button></a></td>
                  </tr>
                  <?php 
                       
                }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>