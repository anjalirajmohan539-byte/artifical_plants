<?php
include("database.php");
include("header.php");
echo $id;

$status = 0;

?>

<link href="css/shipping_customer_details.css" rel="stylesheet">
<body>
    <div class="cl"></div>
     <div class="reg-wrapper">
    <div class="reg-box">
      <form id="regForm" action="shipping_customer_details_act.php" method="post" enctype="multipart/form-data" onSubmit="return validation();">


  <h2>Delivery Details</h2>

   <label for="fullname">Full Name</label>
  <input type="text" id="fullName" name="fullName" class="fullName" placeholder="Enter your full name" onChange="remove_validation('fullname','fullnameErr');">
  <div class="error" id="fullnameErr"></div>

  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" onChange="remove_validation('phoneno','phonenoErr');">
  <div class="error" id="phonenoErr"></div>

  <label for="address">Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"></textarea>
  <div class="error" id="addressErr"></div>

  <label for="zip">Postal Code</label>
  <input type="text" id="Pincode" name="Pincode" class="Pincode" placeholder="Enter your pincode" onChange="remove_validation('pincode','pincodeErr');">
  <div class="error" id="pincodeErr"></div>

  <label for="Place">City</label>
  <input type="text" id="Place" name="Place" class="Place" placeholder="Enter your Place" onChange="remove_validation('Placename','PlaceErr');">
  <div class="error" id="PlaceErr"></div>

   <label for="status">Status</label>
  <select name="status" id="status">
    <option value="0" <?php if($status == 0) echo "selected"; ?>>Active</option>
    <option value="1" <?php if($status == 1) echo "selected"; ?>>InActive</option>
  </select>
  <div class="error" id="cityErr"></div>

  <button type="submit" name="btn" class="btn" id="btn">Save</button>
</form>
    </div>
  </div>

<?php

include('footer.php');

?>
</body>
</html>