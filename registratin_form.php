<?php
include("database.php");
?>



<link href="css/registration_form.css" rel="stylesheet">
    <div class="cl"></div>
     <div class="reg-wrapper">
    <div class="reg-box">
      <form id="regForm" action="registration_action.php" method="post" enctype="multipart/form-data" onSubmit="return validation();">


  <h2>Account Details</h2>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" class="email" placeholder="Enter your email" onChange="remove_validation('email','emailErr');">
  <div class="error" id="emailErr"></div>

  <div class="col-12 pass" style="display: flex; padding:0; gap:2%">
    <div class="col-6" style="display: flex; flex-direction:column; padding:0;">
   <label for="password">Password</label>
  <input type="password" id="password" name="password" class="password" placeholder="Enter your password" onChange="remove_validation('password','passwordErr');">
  <div class="error" id="passwordErr"></div>
</div>

  <div class="col-6" style="display: flex; flex-direction:column; padding:0;">
  <label for="confirm_password">Confirm Password</label>
  <input type="password" id="confirmpassword" name="confirm_password" placeholder="Confirm your password" onChange="remove_validation('confirmpassword','confirmpasswordErr');">
  <div class="error" id="confirmpasswordErr"></div>
  </div>
  </div>
  <br>
  <br>
  <br>


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

<?php
  
  $select_country="SELECT `Id`, `Name` FROM `country`";
  $country_statnmt=mysqli_query($conn,$select_country);

  if(mysqli_num_rows($country_statnmt)>0){
   

  ?>
  <label for="country" class="country">Country</label>
  <select id="country" name="country" required>
    <option value="0">Select Country</option>
    <?php
     while($country=mysqli_fetch_assoc($country_statnmt))
    {
    ?>
    <option value="<?php echo $country["Id"];?>"><?php echo $country["Name"];?></option>
    <?php  }?>

  </select>

<?php  }?>

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
  <button type="submit" name="button" class="button">Register</button>
</form>
    </div>
  </div>
</body>

<script src="js/jquery.min.js"></script>

<!--   registration validation   -->



<script>
function remove_validation(fieldId, errorId) {
  document.getElementById(fieldId).style.border = "";
  document.getElementById(errorId).innerHTML = "";
}

function validation() 
{
  let valid = true;
    

  // Email validation
  let email = document.getElementById("email").value.trim();
  let emailErr = document.getElementById("emailErr");
  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "" || !emailPattern.test(email)) {
    emailErr.innerHTML = "Please enter a valid email address.";
    document.getElementById("email").style.border = "1px solid red";
    valid = false;
  }

  // Password validation
  let password = document.getElementById("password").value.trim();
  let passwordErr = document.getElementById("passwordErr");
  if (password.length < 6) {
    passwordErr.innerHTML = "Password must be at least 6 characters.";
    document.getElementById("password").style.border = "1px solid red";
    valid = false;
  }

  // Confirm password validation
  let confirmPassword = document.getElementById("confirmpassword").value.trim();
  let confirmPasswordErr = document.getElementById("confirmpasswordErr");
  if (confirmPassword === "" || confirmPassword !== password) {
    confirmPasswordErr.innerHTML = "Passwords do not match.";
    document.getElementById("confirmpassword").style.border = "1px solid red";
    valid = false;
  }

  // Full name
  let fullname = document.getElementById("fullname").value.trim();
  let fullnameErr = document.getElementById("fullnameErr");
  if (fullname === "" || fullname.length < 3) {
    fullnameErr.innerHTML = "Please enter your full name.";
    document.getElementById("fullname").style.border = "1px solid red";
    valid = false;
  }

  // Gender
  let male = document.getElementById("male").checked;
  let female = document.getElementById("female").checked;
  if (!male && !female) {
    valid = false;
  }

  // Date of birth
  let dob = document.getElementById("dob").value;
  let dobErr = document.getElementById("dobErr");
  if (dob === "") {
    dobErr.innerHTML = "Please select your date of birth.";
    document.getElementById("dob").style.border = "1px solid red";
    valid = false;
  }

  // Age
  let age = document.getElementById("age").value.trim();
  let ageErr = document.getElementById("ageErr");
  if (age === "" || isNaN(age) || age <= 0) {
    valid = false;
  }

  // Phone number
  let phone = document.getElementById("phone").value.trim();
  let phoneErr = document.getElementById("phonenoErr");
  let phonePattern = /^[0-9]{10}$/;
  if (!phonePattern.test(phone)) {
    phoneErr.innerHTML = "Enter a valid 10-digit phone number.";
    document.getElementById("phone").style.border = "1px solid red";
    valid = false;
  }

  // WhatsApp number
  let whatsapp = document.getElementById("whatsappphone").value.trim();
  let whatsappErr = document.getElementById("whatsappErr");
  if (!phonePattern.test(whatsapp)) {
    whatsappErr.innerHTML = "Enter a valid 10-digit WhatsApp number.";
    document.getElementById("whatsappphone").style.border = "1px solid red";
    valid = false;
  }

  // Address
  let address = document.getElementById("address").value.trim();
  let addressErr = document.getElementById("addressErr");
  if (address.length < 5) {
    addressErr.innerHTML = "Please enter a valid address.";
    document.getElementById("address").style.border = "1px solid red";
    valid = false;
  }

  // Pincode
  let pincode = document.getElementById("zip").value.trim();
  let pincodeErr = document.getElementById("pincodeErr");
  let pinPattern = /^[0-9]{6}$/;
  if (!pinPattern.test(pincode)) {
    pincodeErr.innerHTML = "Enter a valid 6-digit pincode.";
    document.getElementById("zip").style.border = "1px solid red";
    valid = false;
  }

  // City
  let city = document.getElementById("city").value.trim();
  let cityErr = document.getElementById("cityErr");
  if (city === "") {
    cityErr.innerHTML = "Enter your city name.";
    document.getElementById("city").style.border = "1px solid red";
    valid = false;
  }

  // Country dropdown
  let country = document.getElementById("country").value;
  if (country === "0") {
    valid = false;
  }

   // state dropdown
  let state = document.getElementById("state").value;
  if (state === "0") {
    valid = false;
  }

  // Terms and Conditions checkbox
  let checkbox = document.getElementById("checkDefault");
  if (!checkbox.checked) {
    valid = false;
  }

  return valid;
  
}
</script>



<script>

  /* ================= AJAX ================= */

$(document).ready(function () {
    $('#statesContainer').hide();

    $('#country').on('change', function () {
        let materialId = $(this).val();

        if (materialId !== "0" && materialId !== "") {
            $('#statesContainer').slideDown(); 

            $.ajax({
                url: 'fetch_country.php',
                type: 'POST',
                data: { country: materialId },
                success: function (data) {
                    $('#state').html(data);
                }
            });

        } else {
            $('#statesContainer').slideUp();
            $('#state').html('<option value="0">Choose states</option>');
        }
    });

});
</script>

<script>

   /* ================= AGE CALCULATION ================= */

  function calculate_Age() {

    var age = document.getElementById("age");
    var dob = document.getElementById("dob").value;
    var birthDate = new Date(dob);
    var today = new Date();

    var years = today.getFullYear() - birthDate.getFullYear();
    var months = today.getMonth() - birthDate.getMonth();

    if (months < 0) 
      {
        years--;
        months = 12 + months;
    }

    age.value = years ;
}
</script>
</html>