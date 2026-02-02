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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Product - Milon Artificial Plants </title>
  <link rel="stylesheet" href="css/add_product.css">
  <link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="js/jquery.min.js"></script>
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
 
        <div class="col-lg-4">
          <div class="panel-card">
            <h5 class="mb-3">Add Product</h5>

            <form action="add_product_action.php" method="post"  id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">
              <!---------------------------------------------------- Image Preview ---------------------------------------------------->
              <label class="form-label">Product image <s>*</s></label>
              <div class="mb-2">
                <div class="avatar-preview" id="imagePreview" ><span style="<?php echo $imgs != "" ? 'display:none' : '' ?>">No image</span>
                  
                  <?php
                if ($imgs != '') {
                  ?>
                  
                  <img src="images/product/<?php echo $imgs; ?>" alt="">
                <?php } ?>
                </div>
           

                <input type="hidden" name="himage" value="<?php echo empty($prows['ProductImage']) ? "" : $prows['ProductImage'];?>">
                <input class="form-control form-control-sm" name="image" type="file" id="productImage" accept="image/*" >
                <div class="small_error" id="imgErr"></div>
                <div class="form-text" style="font-size: 11px !important;">Recommended: square image. Max 2MB.</div>
              </div>

              <!---------------------------------------------------- Product Name ---------------------------------------------------->
              <div class="mb-3">
                <label class="form-label">Product name <s>*</s></label>
                <input type="text" id="productName" name="productName" class="form-control" placeholder="e.g. Classic White Vase"
                value="<?php echo $prows == '' ? '' : $prows['ProductName'];?>" required>
                <div class="small_error" id="nameErr"></div>
                <div class="invalid-feedback">Product name is required.</div>
              </div>

              <!---------------------------------------------------- Product Type ---------------------------------------------------->
              <div class="mb-3">
                <?php
            $select = "SELECT `Id`, `Categorys` FROM `product_category` WHERE IsDeleted = 0";
            $statment = mysqli_query($conn, $select);

            if (mysqli_num_rows($statment) > 0) {


              ?>
                <label class="form-label">Product type <s>*</s></label>
                <select class="form-select" name="productType" id="productType" required>
                  <option value="0">Choose type</option>
                  <?php
                  while ($type = mysqli_fetch_assoc($statment)) {
                  ?>
                  <option value="<?php echo $type['Id'];?>" <?php echo ($prows != "" && $type['Id'] == $prows['CategoryId']) ? 'selected' : ''; ?>><?php echo $type['Categorys']?></option>
                  <?php }?>
                </select>
                <?php }?>
                <div class="invalid-feedback">Please choose type.</div>
                <div class="small_error" id="typeErr"></div>
              </div>

                      <div style="display:flex; gap:50px;">
            <div style="display:flex; flex-direction:column;">
              <label>Color Name <s>*</s></label>
              <input type="text" name="colorName" class="form-control" id="color" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. White"
              value="<?php echo $prows == "" ? "" : $prows['ColorName'] ?>">
                <div class="small_error" id="colorErr"></div>
            </div>
            <div style="display:flex; flex-direction:column;">
              <label>Color Code <s>*</s></label>
              <input type="text" name="colorCode" class="form-control" id="code" style="width: 100%;margin-bottom: 10px;" placeholder="e.g. #fff"
              value="<?php echo $prows == "" ? "" : $prows['ColorCode'] ?>">
                <div class="small_error" id="codeErr"></div>
            </div>
          </div>

          <!---------------------------------------------------- Product price ---------------------------------------------------->

          <div style="display: flex; gap: 50px;">
            <div style="display:flex; flex-direction:column;">
            <label for="productPrice">Product price (₹) <s>*</s></label>
            <input id="productPrice" class="form-control" name="productPrice" style="width: 100%;margin-bottom: 10px;" type="number" min="0" step="0.01" placeholder="e.g. 499.00"
            value="<?php echo $prows == "" ? "" : $prows['Price'] ?>">
            <div class="small_error" id="priceErr"></div>
            </div>
          
          <div style="display:flex; flex-direction:column;">
            <label for="productcount">Product Count <s>*</s></label>
            <input id="productcount" class="form-control" name="productcount" style="width: 100%;margin-bottom: 10px;" type="number" placeholder="e.g. 1"
            value="<?php echo $prows == "" ? "" : $prows['ProductCount'] ?>">
            <div class="small_error" id="countErr"></div>
          </div>
          </div>

            <!---------------------------------------------------- Product Material ---------------------------------------------------->
              <div class="mb-3">
                  <?php
            $select_met = "SELECT `Id`, `Name` FROM `material_type` WHERE IsDeleted = 0";
            $statemnt = mysqli_query($conn, $select_met);

            if (mysqli_num_rows($statemnt) > 0) {

              ?>
                <label class="form-label">Product Materials <s>*</s></label>
                <select class="form-select" name="productMaterial" id="productMaterials" required>
                  <option value="0">Choose Materials</option>
                  <?php
                while ($material = mysqli_fetch_assoc($statemnt)) {

                  ?>
                  <option value="<?php echo $material['Id'];?>" <?php echo ($prows != "" && $material['Id'] == $prows['MaterialId']) ? 'selected' : '' ?>><?php echo $material['Name'];?></option>
                  <?php }?>
                </select>
                <?php 
                }?>
                <div class="invalid-feedback">Please choose a material.</div>
                <div class="small_error" id="materialErr"></div>
              </div>

              <!---------------------------------------------------- Product Category ---------------------------------------------------->
              <div class="mb-3" id="categoryContainer" style="display: none;">
                <label class="form-label">Product Category <s>*</s></label>
                <select class="form-select" name="materialCategory" id="productCategory" required>
                </select>
                <div class="invalid-feedback">Please choose a category.</div>
                <div class="small_error" id="categoryErr"></div>
              </div>

              <!---------------------------------------------------- Description ---------------------------------------------------->
              <div class="mb-3">
                <label class="form-label">Description <s>*</s></label>
                <textarea id="description" name="productDesc" class="form-control" rows="4" placeholder="Short description (optional)"><?php echo $prows == "" ? "" : $prows['Description'] ?></textarea>
                <div class="small_error" id="descErr"></div>
              </div>

               <!---------------------------------------------------- Btn ---------------------------------------------------->

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-brown" id="btn" name="btn" onsubmit="ValidationForm()"><?php echo $button; ?></button>
                <button type="button" id="resetBtn" class="btn secondary">Reset</button>
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="productsTable">
                  <?php
                  $select = "SELECT ap.`Id`, `Price`, `ProductName`, pc.Categorys AS `CategoryId`, ap.`CreateDate` FROM `add_product` ap
                                 INNER JOIN product_category pc ON pc.Id = ap.CategoryId WHERE ap.IsDeleted = 0";
                  $staemnt = mysqli_query($conn,$select);

                  $sl = 1;
                  if(mysqli_num_rows($staemnt)>0)
                  {

                  while($product=mysqli_fetch_assoc($staemnt))
                  {

                  
                  ?>
                  <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $product['ProductName'];?></td>
                    <td><?php echo $product['CategoryId'];?></td>
                    <td><?php echo $product['Price'];?></td>

<!------- view button ------->

                    <td>
                      <a href="product_details.php?productId=<?php echo $product['Id']; ?>" title="View"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg></a>
                    </td>

<!------- color button ------->

                    <td>
                      <a href="color.php?productId=<?php echo $product['Id']; ?>" title="Color"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-palette" viewBox="0 0 16 16">
  <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8m-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7"/>
</svg></a>
                    </td>

<!------- Image button ------->

                    <td>
                      <a href="image.php?productId=<?php echo $product['Id']; ?>" title="Image"><svg xmlns="http://www.w3.org/2000/svg" 
                      width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
</svg></a>
                    </td>

<!------- Delivery details button ------->

                    <td>
                      <a href="delivery_details.php?productId=<?php echo $product['Id']; ?>" title="Delivery">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
  <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
</svg>
</a>
                    </td>

<!------- Pair button ------->

                    <td>
                      <a href="product_pair.php?productId=<?php echo $product['Id'];?>" title="Product Pair">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="16" height="16" viewBox="0 0 24 24" version="1.1">
    <g id="🔍-System-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="ic_fluent_arrow_repeat_all_24_filled" fill="currentColor" fill-rule="nonzero">
            <path d="M20,7.67839023 C20.3191373,7.67839023 20.6033578,7.8277818 20.7864517,8.06040161 L20.7868129,8.0569409 C21.552384,9.17836413 22,10.5338305 22,11.9937699 C22,15.7761413 18.9955544,18.857279 15.2414096,18.9840181 L15.0007869,18.9880738 L9.405,18.9874442 L10.7086806,20.2904605 L10.7863869,20.3776202 C11.0972124,20.7698625 11.0713103,21.3413068 10.7086806,21.7036822 C10.3481966,22.0639133 9.78096555,22.0916234 9.38867434,21.7868124 L9.29446701,21.7036822 L6.28926319,18.7005862 L6.21155682,18.6134265 C5.92663349,18.2538711 5.92465485,17.7437362 6.20562092,17.3820893 L6.28926319,17.2873645 L9.29446701,14.2842685 L9.38168782,14.2066167 C9.74149567,13.9218932 10.2519886,13.9199159 10.6138893,14.2006849 L10.7086806,14.2842685 L10.7863869,14.3714282 C11.0713103,14.7309837 11.0732889,15.2411186 10.7923228,15.6027654 L10.7086806,15.6974902 L9.415,16.988847 L15.0007869,16.9894766 C17.7617761,16.9894766 20,14.7528225 20,11.9937699 C20,10.9755377 19.6951563,10.0284557 19.1716955,9.23868979 C19.0637032,9.07917977 19,8.88586843 19,8.67768884 C19,8.12579146 19.4477153,7.67839023 20,7.67839023 Z M14.6250898,2.21140589 L14.7123106,2.28905775 L17.7175144,5.29215375 C18.0801441,5.6545291 18.1060462,6.22597341 17.7952208,6.61821576 L17.7175144,6.70537539 L14.7123106,9.70847139 C14.3217863,10.0987218 13.6886213,10.0987218 13.298097,9.70847139 C12.9354673,9.34609604 12.9095652,8.77465173 13.2203907,8.38240938 L13.298097,8.29524975 L14.595,6.9978595 L8.99921311,6.99806318 C6.23822395,6.99806318 4,9.23471726 4,11.9937699 C4,12.9117144 4.24775158,13.771834 4.6800791,14.5109974 L4.81525146,14.7290546 C4.93132393,14.8915256 5,15.0916491 5,15.3078015 C5,15.8596989 4.55228475,16.3071002 4,16.3071002 C3.66599922,16.3071002 3.37024338,16.143469 3.18863074,15.8920517 C2.43832928,14.7808948 2,13.4384851 2,11.9937699 C2,8.21139848 5.0044456,5.13026076 8.75859041,5.00352168 L8.99921311,4.99946596 L14.597,4.99926229 L13.298097,3.7022794 C12.9354673,3.33990404 12.9095652,2.76845974 13.2203907,2.37621739 L13.298097,2.28905775 C13.6607267,1.9266824 14.2325721,1.90079845 14.6250898,2.21140589 Z" id="🎨-Color">

</path>
        </g>
    </g>
</svg>
</a>
                    </td>



                                        <td>
                      <a href="product_Offers.php?productId=<?php echo $product['Id'];?>" title="Product Pair">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="16" height="16" viewBox="0 0 24 24" version="1.1">
    <g id="🔍-System-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="ic_fluent_arrow_repeat_all_24_filled" fill="currentColor" fill-rule="nonzero">
            <path d="M20,7.67839023 C20.3191373,7.67839023 20.6033578,7.8277818 20.7864517,8.06040161 L20.7868129,8.0569409 C21.552384,9.17836413 22,10.5338305 22,11.9937699 C22,15.7761413 18.9955544,18.857279 15.2414096,18.9840181 L15.0007869,18.9880738 L9.405,18.9874442 L10.7086806,20.2904605 L10.7863869,20.3776202 C11.0972124,20.7698625 11.0713103,21.3413068 10.7086806,21.7036822 C10.3481966,22.0639133 9.78096555,22.0916234 9.38867434,21.7868124 L9.29446701,21.7036822 L6.28926319,18.7005862 L6.21155682,18.6134265 C5.92663349,18.2538711 5.92465485,17.7437362 6.20562092,17.3820893 L6.28926319,17.2873645 L9.29446701,14.2842685 L9.38168782,14.2066167 C9.74149567,13.9218932 10.2519886,13.9199159 10.6138893,14.2006849 L10.7086806,14.2842685 L10.7863869,14.3714282 C11.0713103,14.7309837 11.0732889,15.2411186 10.7923228,15.6027654 L10.7086806,15.6974902 L9.415,16.988847 L15.0007869,16.9894766 C17.7617761,16.9894766 20,14.7528225 20,11.9937699 C20,10.9755377 19.6951563,10.0284557 19.1716955,9.23868979 C19.0637032,9.07917977 19,8.88586843 19,8.67768884 C19,8.12579146 19.4477153,7.67839023 20,7.67839023 Z M14.6250898,2.21140589 L14.7123106,2.28905775 L17.7175144,5.29215375 C18.0801441,5.6545291 18.1060462,6.22597341 17.7952208,6.61821576 L17.7175144,6.70537539 L14.7123106,9.70847139 C14.3217863,10.0987218 13.6886213,10.0987218 13.298097,9.70847139 C12.9354673,9.34609604 12.9095652,8.77465173 13.2203907,8.38240938 L13.298097,8.29524975 L14.595,6.9978595 L8.99921311,6.99806318 C6.23822395,6.99806318 4,9.23471726 4,11.9937699 C4,12.9117144 4.24775158,13.771834 4.6800791,14.5109974 L4.81525146,14.7290546 C4.93132393,14.8915256 5,15.0916491 5,15.3078015 C5,15.8596989 4.55228475,16.3071002 4,16.3071002 C3.66599922,16.3071002 3.37024338,16.143469 3.18863074,15.8920517 C2.43832928,14.7808948 2,13.4384851 2,11.9937699 C2,8.21139848 5.0044456,5.13026076 8.75859041,5.00352168 L8.99921311,4.99946596 L14.597,4.99926229 L13.298097,3.7022794 C12.9354673,3.33990404 12.9095652,2.76845974 13.2203907,2.37621739 L13.298097,2.28905775 C13.6607267,1.9266824 14.2325721,1.90079845 14.6250898,2.21140589 Z" id="🎨-Color">

</path>
        </g>
    </g>
</svg>
</a>
                    </td>

<!------- Edit button ------->

                    <td>
                      <form action="#" method="post">
                        <input type="hidden" name="productid" value="<?php echo $product['Id']; ?>">
                        
                      <button type="submit" name="edit" style="border: none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
</form>
                    </td>
                    
<!------- Delete button ------->

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
                  <?php }}?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

 <!---------------------------------------------------- JAVASCRIPT ---------------------------------------------------->


<script>

/* ================= IMAGEPREVIEW ================= */

document.getElementById("productImage").addEventListener("change", function () {
    let file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = e => {
            document.getElementById("imagePreview").innerHTML =
                `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">`;
        };
        reader.readAsDataURL(file);
    }
});


</script>

<script>
document.getElementById("productForm").addEventListener("submit", function (e) {
    if (!ValidationForm()) {
        e.preventDefault();
    }
});



/* ================= VALIDATION ================= */
function ValidationForm() {
    let valid = true;

    // Get values
    let image = document.getElementById("productImage").files[0];
    let name = document.getElementById("productName").value.trim();
    let type = document.getElementById("productType").value;
    let price = document.getElementById("productPrice").value;
    let count = document.getElementById("productcount").value;
    let material = document.getElementById("productMaterials").value;
    let category = document.getElementById("productCategory").value;
    let description = document.getElementById("description").value;
    let color = document.getElementById("color").value.trim();
    let code = document.getElementById("code").value.trim();

    // Clear old errors
    document.querySelectorAll(".error, #imgErr, #nameErr, #typeErr, #descErr").forEach(el => el.innerText = "");

    /* Image */
    if (!image) {
        document.getElementById("imgErr").innerText = "Please upload product image";
        document.getElementById("productImage").style.border = "1px solid red";
        valid = false;
    }

    /* Name */
    if (name === "") {
        document.getElementById("nameErr").innerText = "Product name required";
        document.getElementById("productName").style.border = "1px solid red";
        valid = false;
    }

    /* Type */
    if (type === "0") {
        document.getElementById("typeErr").innerText = "Select product type";
        document.getElementById("productType").style.border = "1px solid red";
        valid = false;
    }

    /* Price */
    if (price === "" || price <= 0) {
        document.getElementById("priceErr").innerText = "Enter valid price";
        document.getElementById("productPrice").style.border = "1px solid red";
        valid = false;
    }

    /* Material */
    if (material === "0") {
        document.getElementById("materialErr").innerText = "Select material";
        document.getElementById("productMaterials").style.border = "1px solid red";
        valid = false;
    }

    /* Category */
    if (!category || category === "0") {
        document.getElementById("categoryErr").innerText = "Select category";
        document.getElementById("productCategory").style.border = "1px solid red";
        valid = false;
    }

      /* description */
    if (name === "") {
        document.getElementById("descErr").innerText = "Product Description required";
        document.getElementById("description").style.border = "1px solid red";
        valid = false;
    }

    return valid;
}

</script>

<script>

  /* ================= RESETBTN ================= */


document.getElementById("resetBtn").addEventListener("click", function () {

  // Reset form fields
  document.getElementById("productForm").reset();
  document.getElementById("productMaterials").style.border = "";
  document.getElementById("productName").style.border = "";
  document.getElementById("productImage").style.border = "";
  document.getElementById("productType").style.border = "";
  document.getElementById("productCategory").style.border = "";
  document.getElementById("description").style.border = "";
  document.getElementById("productPrice").style.border = "";

  // Clear all validation error messages
  document.querySelectorAll(".small_error").forEach(el => {
    el.innerText = "";
  });

  // Reset image preview
  const preview = document.getElementById("imagePreview");
  preview.style.backgroundImage = "";
  preview.innerText = "No image";

  // Reset category dropdown
const category = document.getElementById("productCategory");
category.innerHTML = "<option value='0'>Choose category</option>";

// Hide category field
document.getElementById("categoryContainer").style.display = "none";
});
</script>




<script>

  /* ================= AJAX ================= */


$(document).ready(function () {
    $('#categoryContainer').hide();

    $('#productMaterials').on('change', function () {
        let materialId = $(this).val();

        if (materialId !== "0" && materialId !== "") {
            $('#categoryContainer').slideDown(); 

            $.ajax({
                url: 'fetch_category.php',
                type: 'POST',
                data: { productMaterial: materialId },
                success: function (data) {
                    $('#productCategory').html(data);
                }
            });

        } else {
            $('#categoryContainer').slideUp();
            $('#productCategory').html('<option value="0">Choose category</option>');
        }
    });

});
</script>


</script>
</body>
</html>