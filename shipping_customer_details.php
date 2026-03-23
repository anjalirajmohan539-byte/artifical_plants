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

  <div class="col-12 name">
    <div class="col-6"> 
   <label for="fullname">Full Name</label>
  <input type="text" id="fullName" name="fullName" class="fullName" placeholder="Enter your full name" onChange="remove_validation('fullname','fullnameErr');">
  <input type="hidden" id="customerId" name="customerId" value="<?php echo $id;?>">
  <div class="error" id="fullnameErr"></div>
</div>

  <div class="col-6">
  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" onChange="remove_validation('phoneno','phonenoErr');">
  <div class="error" id="phonenoErr"></div>
  </div>
</div>

  <label for="address">Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"></textarea>
  <div class="error" id="addressErr"></div>

  <div class="col-12 pin">
    <div class="col-6">
  <label for="zip">Postal Code</label>
  <input type="text" id="Pincode" name="Pincode" class="Pincode" placeholder="Enter your pincode" onChange="remove_validation('pincode','pincodeErr');">
  <div class="error" id="pincodeErr"></div>
  </div>


  <div class="col-6">
  <label for="Place">City</label>
  <input type="text" id="Place" name="Place" class="Place" placeholder="Enter your Place" onChange="remove_validation('Placename','PlaceErr');">
  <div class="error" id="PlaceErr"></div>
  </div>
</div>

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

  <div class="container list">
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Phone No</th>
          <th>Address</th>
          <th>Pin Code</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <?php
      $setectDetails = "SELECT `Name`, `Address`, `PhoneNo`, `Pincode`,
                        CASE WHEN Status =0 THEN 'Active'
                             WHEN Status =1 THEN 'Inactive'
                        END AS Status 
                        FROM `delivery_customer_details` WHERE `Customer_Id` = $id";
      $check = mysqli_query($conn,$setectDetails);
      // var_dump($setectDetails);

      if(mysqli_num_rows($check)>0)
        {
          while($details = mysqli_fetch_assoc($check))
            { 
      ?>
      <tbody>
        <tr>
          <td><?php echo $details['Name'];?></td>
          <td><?php echo $details['PhoneNo'];?></td>
          <td><?php echo $details['Address'];?></td>
          <td><?php echo $details['Pincode'];?></td>
          <td><?php echo $details['Status'];?></td> 
          <td><button>Edit</button></td> 
        </tr>
      </tbody>
      <?php   }
        }?>
    </table>
  </div>

<?php

include('footer.php');

?>
</body>
</html>