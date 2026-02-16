<?php

include('database.php');

$status = 0;
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/product_offers.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
        <!-- SIDEBAR -->
<?php
include('sidebar.php');

?>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Offers Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add Offers</h3>
            <form action="product_Offers_action.php" method="post" id="productForm" autocomplete="off">
            <label>Offers Name <s>*</s></label>
            <input type="text" id="OffersName" name="OffersName" value="" placeholder="Enter offer name" oninput="clearError('colorErr')">
            <div class="error" id="colorErr"></div>

            <?php
                $offerSelect = "SELECT `Id`, `Name` FROM `offer_type` WHERE `IsDeleted` = 0";
                $check1 = mysqli_query($conn,$offerSelect);

                if(mysqli_num_rows($check1)>0)
                {

                ?>
            <label>Offers Type <s>*</s></label>
            <select class="form-select" name="offerType" id="offerType" required>
                  <option value="0">Choose type</option>
                  <?php
                   while($offer = mysqli_fetch_assoc($check1))
                  {
                  ?>
                  <option value="<?php echo $offer['Id'];?>" ><?php echo $offer['Name'];?></option>
                  <?php }?>
                </select>
            <div class="error" id="colorErr"></div>
            <?php }?>

            <label>Offers Code <s>*</s></label>
            <input type="text" id="OffersCode" name="OffersCode" value="" placeholder="Enter offer name" oninput="clearError('colorErr')">
            <div class="error" id="colorErr"></div>

            <?php
                  $discount = "SELECT `Id`, `Name` FROM `discount_type` WHERE  `IsDeleted` = 0";
                  $statement = mysqli_query($conn,$discount);

                  if(mysqli_num_rows($statement)>0)
                  {

                  ?>
            <label>Discount Type <s>*</s></label>
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
            <div class="error" id="colorErr"></div>

            <label>Discount Value <s>*</s></label>
            <input type="text" id="DiscountValue" name="DiscountValue" value="" placeholder="Enter offer name" oninput="clearError('colorErr')">
            <div class="error" id="colorErr"></div>

            <label>Status <s>*</s></label>
            <select class="form-select" name="Status" id="Status" required>
                  <option value="0" <?php if($status == 0) echo "selected"; ?>>Active</option>
                  <option value="1" <?php if($status == 1) echo "selected"; ?>>InActive</option>
                  <option value="2" <?php if($status == 2) echo "selected"; ?>>Expired</option>
                  <option value="3" <?php if($status == 3) echo "selected"; ?>>Schedule</option>
                </select>
            <div class="error" id="colorErr"></div>

             <button class="btn btn-save" id="add" name="btn" onclick="return validateForm()">Save</button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
            </form>
        </div>

        
       
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Offers</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                  $selectSql = "SELECT `Id`, `OfferName` FROM `offers` WHERE  `IsDelete`=0";
                  $checksql = mysqli_query($conn,$selectSql);

                  $sl=1;
                  if(mysqli_num_rows($checksql)>0)
                    {
                      $sql=mysqli_fetch_assoc($checksql);
                    
                  
                  ?>
            <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $sql['OfferName'];?></td>
                    <td>
                        <form action="#" method="post">
                        <button type="submit" name="edit" style="border:none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
</form>
                    </td>
                    <td>
                            <button type="submit" name="delete" style="border:none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                    </td>
                    </tr>
                    <?php }?>
            </table>
        </div>

    </div>
</div>
</body>
</html>