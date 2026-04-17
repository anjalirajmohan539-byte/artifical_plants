<?php
include('header.php');
?>

<link href="css/personal_information.css" rel="stylesheet">
    <div class="cl"></div>
     <div class="reg-wrapper">
    <div class="reg-box">
      <form id="regForm" action="#" method="post" enctype="multipart/form-data" onSubmit="return validation();">


  <h2 style="margin-top: 35px;">Personal Details</h2>

<aside class="card-right">
<div class="avatar-preview" id="avatarBox">
        <div style="text-align:center;padding:10px;color:white">
          <div style="font-size:18px;font-weight:700;color:white">Welcome!</div>
          <div class="small1">Upload a profile photo to preview here.</div>
        </div>
      </div>
     
</aside>

  <label for="customer_image"></label>
   <div class="small">Upload a square photo (will be cropped).</div>
  <input id="avatar" name="image" class="image" type="file" accept="images/*">

   <label for="fullname">Full Name</label>
  <input type="text" id="fullname" name="fullname" class="fullname" placeholder="Enter your full name" onChange="remove_validation('fullname','fullnameErr');">
  <div class="error" id="fullnameErr"></div>

 
<!-- numbers -->

  <div class="col-12" style="display: flex; gap:2%; padding:0;"> 
    <div class="col-6" style="display: flex; flex-direction:column; padding:0;">
  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" style="margin-bottom: 20px;" onChange="remove_validation('phoneno','phonenoErr');">
  <div class="error" id="phonenoErr"></div>
</div>

  <div class="col-6" style="display: flex; flex-direction:column; padding:0;">
    <label for="phone">WhatsApp Number</label>
  <input type="tel" id="whatsappphone" name="whatsapp_phone" class="whatsapp_phone" placeholder="Enter your whatsapp number" onChange="remove_validation('whatsapp','whatsappErr');">
  <div class="error" id="whatsappErr"></div>
</div>
                
  </div>

  
  <div class="col-12 personal" style="display: flex; padding:0;">

  <!-- Gender -->

  <div class="gen">
    <div class="col-4 gender" style="padding:0;">
    <label for="gender" id="gender">Gender</label>
	<input type="radio" id="male" value="0" name="male" >
	<h3 class="male">Male</h3>
  <div class="error" id="maleErr"></div>

	<input type="radio" id="female" value="1" name="male">
	<h3 class="male">Female</h3>
  <div class="error" id="femaleErr"></div>
    </div>
    </div>                        

  <!-- DOB & Age -->

<div class="dobAge" style="display: flex;gap: 110px; margin-top: -20px;">
  <div class="col-4" style="display: flex; flex-direction:column; padding:0;">
  <label for="date_birth">Date of Birth</label>
  <input type="date" id="dob" name="dob" class="dob" style="width:125%;" placeholder="Enter your date of birth" onChange="calculate_Age()">
  <div class="error" id="dobErr"></div>  
  </div>

  <div class="col-4" style="display: flex; flex-direction:column; padding:0;">
  <label for="age">Age</label>
  <input type="text" id="age" name="age" class="age" style="width:125%;" readonly>
  <div class="error" id="ageErr"></div>                           
  </div>
  </div>

  </div>

  <!-- Address -->

  <label for="address">Street Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"></textarea>
  <div class="error" id="addressErr"></div>

  <!-- P O -->

  <label for="zip">Postal Code</label>
  <input type="text" id="zip" name="zip" class="pincode" placeholder="Enter your pincode" onChange="remove_validation('pincode','pincodeErr');">
  <div class="error" id="pincodeErr"></div>

  <!-- City -->

  <label for="city">City</label>
  <input type="text" id="city" name="city" class="city" placeholder="Enter your city" onChange="remove_validation('cityname','cityErr');">
  <div class="error" id="cityErr"></div>

  <!-- Country -->
  <label for="country" class="country">Country</label>
  <select id="country" name="country" required>
    <option value="0">Select Country</option>
    <option value=""></option>
  </select>

<!-- State -->

<div id="statesContainer" class="statesContainer">
  <label for="state" class="status">State</label>
  <select id="state" name="state">
  </select>
  </div>
  

 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="checkDefault">
  <label class="form-check-label" for="checkDefault">
   I agree to the Terms & Conditions
  </label>
</div>
  <button type="submit" name="button" class="button">Edit</button>
</form>
    </div>
  </div>
</body>
</html>