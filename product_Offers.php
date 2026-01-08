<?php

include('database.php');

$product_id = $_GET['productId'];
$status = 0;
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Product - Milon Artificial Plants </title>
  <link rel="stylesheet" href="css/product_Offers.css">
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

  <h1>Add Offers</h1>
    <div class="container-fluid container-main" style="margin-top: 25px;">
      <div class="row gx-4">
 
        <div class="col-lg-4">
          <div class="panel-card">
            <h5 class="mb-3">Add Offers</h5>

            <form action="product_Offers_action.php" method="post"  id="productForm" autocomplete="off" novalidate enctype="multipart/form-data">

              <!---------------------------------------------------- Product Name ---------------------------------------------------->
              <div class="mb-3">
                <label class="form-label">Offers name <s>*</s></label>
                <input type="text" id="offerName" name="offerName" class="form-control"  required>
                <input type="hidden" id="proId" name="proId" value="<?php echo $product_id;?>">
              </div>

              <!---------------------------------------------------- Product Type ---------------------------------------------------->

              <div class="mb-3">
                <?php
                $offerSelect = "SELECT `Id`, `Name` FROM `offer_type` WHERE `IsDeleted` = 0";
                $check1 = mysqli_query($conn,$offerSelect);

                if(mysqli_num_rows($check1)>0)
                {

                ?>
                <label class="form-label">Offers type <s>*</s></label>
                <select class="form-select" name="offerType" id="offerType" required>
                  <option value="0">Choose type</option>
                  <?php
                   while($offer = mysqli_fetch_assoc($check1))
                  {
                  ?>
                  <option value="<?php echo $offer['Id'];?>" ><?php echo $offer['Name'];?></option>
                  <?php }?>
                </select>
                <?php }?>
              </div>

            <!---------------------------------------------------- Product Material ---------------------------------------------------->
              <div class="mb-3">
                <label class="form-label">Offer Code <s>*</s></label>
                  <input type="text" id="offerCode" name="offerCode" class="form-control" required>
              </div>


            <!---------------------------------------------------- Product Material ---------------------------------------------------->
       
                <div class="mb-3">
                  <?php
                  $discount = "SELECT `Id`, `Name` FROM `discount_type` WHERE  `IsDeleted` = 0";
                  $statement = mysqli_query($conn,$discount);

                  if(mysqli_num_rows($statement)>0)
                  {

                  ?>
                <label class="form-label">Discount type <s>*</s></label>
                <select class="form-select" name="discountType" id="discountType" required>
                  <option value="0">Choose type</option>
                  <?php
                  while($discount = mysqli_fetch_assoc($statement))
                  {

                  ?>
                  <option value="<?php echo $discount['Id'];?>"><?php echo $discount['Name'];?></option>
                  <?php  }?>
                </select>
                <?php }?>
              </div>

            <!---------------------------------------------------- Product Material ---------------------------------------------------->

                <div class="mb-3">
                <label class="form-label">Discount Value <s>*</s></label>
                <input type="number" id="discountvalue" name="discountvalue" class="form-control">
                </select>
              </div>

            <!---------------------------------------------------- Product Material ---------------------------------------------------->

                     <div class="mb-3">
                <label class="form-label">Status <s>*</s></label>
                <select class="form-select" name="Status" id="Status" required>
                  <option value="0" <?php if($status == 0) echo "selected"; ?>>Active</option>
                  <option value="1" <?php if($status == 1) echo "selected"; ?>>InActive</option>
                  <option value="2" <?php if($status == 2) echo "selected"; ?>>Expired</option>
                </select>
              </div>


               <!---------------------------------------------------- Btn ---------------------------------------------------->

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-brown" id="btn" name="btn" onsubmit="ValidationForm()">Add offers</button>
                <button type="button" id="resetBtn" class="btn secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Right column: product list + main image -->
        <div class="col-lg-8">
          <div class="panel-card mb-3">
            <h5>Offer Details</h5>
            <div class="table-responsive">
              <table class="table table-sm align-middle">
                <thead>
                  <tr>
                    <th>Sl no</th>
                    <th>Product</th>
                    <th>Offers</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="productsTable">
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>

<!------- Edit button ------->

                    <td>
                      <button type="submit" name="edit" style="border: none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
                    </td>
                    
<!------- Delete button ------->

                    <td>
                      <button type="submit" name="delete" style="border: none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
</body>
</html>