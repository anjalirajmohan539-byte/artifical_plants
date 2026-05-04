<?php
include('database.php');
include('header.php');

$Id;
?>

<link href="css/personal_information.css" rel="stylesheet">
    <div class="cl"></div>
     <div class="container reg-wrapper">
    <div class="reg-box">
      <form id="regForm" action="personal_information_action.php" method="post" enctype="multipart/form-data" onSubmit="return validation();">
<?php

$select="SELECT `FullName`, `PhoneNo`, `Email`, `Address` FROM `customer_details` WHERE `IsDeleted` = 0 AND `CustomerId` = $Id";
$check = mysqli_query($conn,$select);

if(mysqli_num_rows($check)>0)
  {
    $details=mysqli_fetch_assoc($check);
  
?>

  <h2 style="margin-top: 35px;">Personal Details</h2>

   <label for="fullname">Full Name</label>
  <input type="text" id="fullname" name="fullname" class="fullname" value="<?php echo $details['FullName'];?>">
  <div class="error" id="fullnameErr"></div>
<input type="hidden" name="cusId" value="<?php echo $Id;?>">
 
<!-- numbers -->

  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" style="margin-bottom: 20px;" value="<?php echo $details['PhoneNo'];?>">

  <!-- Address -->

  <label for="address">Street Address</label>
  <textarea id="address" name="address" class="address"><?php echo $details['Address'];?></textarea>
  <div class="error" id="addressErr"></div>   


  <label for="email">Email</label>
  <input type="email" id="email" name="email" class="email" value="<?php echo $details['Email'];?>">
  <div class="error" id="emailErr"></div>

    <?php
    }
    ?>
    <div class="cl"></div>
    <div class="div faq">
      <h2 style="text-align:left;margin-top:20px;">FAQs</h2>
      <p>
        What happens when I update my email address (or mobile number)?<br>
Your login email ID (or mobile number) for Milon Artificial Plant will be updated accordingly. You will receive all your account-related communications on your new email address (or mobile number).
<br>
<br>
When will my Milon Artificial Plant account be updated with the new email address (or mobile number)?<br>
Your account will be updated immediately after you confirm the verification code sent to your email (or mobile) and save the changes.
<br>
<br>
What happens to my existing Milon Artificial Plant account when I update my email address (or mobile number)?<br>
Updating your email address (or mobile number) will not affect your account. Your account will remain fully functional, and you will continue to have access to your order history, saved information, and personal details.
<br>
<br>
Does my Seller account get affected when I update my email address?<br>
Milon Artificial Plant follows a single sign-on policy. Any changes made to your email address (or mobile number) will also be reflected in your Seller account.
      </p>
    </div>

  <button type="submit" name="button" class="button">update change</button>
</form>
    </div>
  </div>
</body>
</html>