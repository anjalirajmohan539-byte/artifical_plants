<?php
include("database.php");
include("header.php");

$editid = "";
$data = "";
$button = "Save";
if(isset($_POST['edit']))
  {
    $editid = $_POST['editid'];
    $button = "Update";

    $select = "SELECT `Name`, `Address`, `PhoneNo`, `Pincode`, `Place`, `Status` FROM `delivery_customer_details` WHERE `Id` = $editid";
    // var_dump($select);
    $check = mysqli_query($conn,$select);
    

    if(mysqli_num_rows($check)>0)
      {
        $data = mysqli_fetch_assoc($check);
      }
  }

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
  <input type="text" id="fullName" name="fullName" class="fullName" placeholder="Enter your full name" value="<?php echo $data == "" ? "" : $data['Name'] ;?>" onChange="remove_validation('fullname','fullnameErr');">
  <input type="hidden" id="customerId" name="customerId" value="<?php echo $Id;?>">
  <input type="hidden" id="editId" name="editId" value="<?php echo $editid;?>">
  <div class="error" id="fullnameErr"></div>
</div>

  <div class="col-6">
  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" value="<?php echo $data == "" ? "" : $data['PhoneNo'];?>" onChange="remove_validation('phoneno','phonenoErr');">
  <div class="error" id="phonenoErr"></div>
  </div>
</div>

  <label for="address">Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"><?php echo $data == "" ? "" : $data['Address'];?></textarea>
  <div class="error" id="addressErr"></div>

  <div class="col-12 pin">
    <div class="col-6">
  <label for="zip">Postal Code</label>
  <input type="text" id="Pincode" name="Pincode" class="Pincode" placeholder="Enter your pincode" value="<?php echo $data == "" ? "" : $data['Pincode'];?>" onChange="remove_validation('pincode','pincodeErr');">
  <div class="error" id="pincodeErr"></div>
  </div>


  <div class="col-6">
  <label for="Place">Place</label>
  <input type="text" id="Place" name="Place" class="Place" placeholder="Enter your Place" value="<?php echo $data == "" ? "" : $data['Place'];?>" onChange="remove_validation('Placename','PlaceErr');">
  <div class="error" id="PlaceErr"></div>
  </div>
</div>

   <label for="status">Status</label>
  <select name="status" id="status">
    <option value="0" <?php echo ($data != "" ? ($data['Status'] == 0 ? "selected" : "") : ""); ?>>Active</option>
    <option value="1" <?php echo ($data != "" ? ($data['Status'] == 1 ? "selected" : "") : ""); ?>>InActive</option>
  </select>
  <div class="error" id="cityErr"></div>

  <button type="submit" name="btn" class="btn" id="btn"><?php echo $button;?></button>
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
      $setectDetails = "SELECT `Id`, `Name`, `Address`, `PhoneNo`, `Pincode`,
                        CASE WHEN Status =0 THEN 'Active'
                             WHEN Status =1 THEN 'Inactive'
                        END AS Status 
                        FROM `delivery_customer_details` WHERE `Customer_Id` = $Id ORDER BY LastUpdate DESC";
                        // var_dump($setectDetails);

      $check = mysqli_query($conn,$setectDetails);
      

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
          <td>
            <form action="#" method="post">
                        <input type="hidden" name="editid" value="<?php echo $details['Id']; ?>">
                      <button type="submit" class="edit" name="edit" style="border: none;background:transparent;  margin-top:0px;
  margin-left:0%;padding:0px;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
</form>
          </td> 
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