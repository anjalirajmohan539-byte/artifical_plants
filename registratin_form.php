<?php
include("database.php");
include('header.php');
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

   <label for="password">Password</label>
  <input type="password" id="password" name="password" class="password" placeholder="Enter your password" onChange="remove_validation('password','passwordErr');">
  <div class="error" id="passwordErr"></div>

  <label for="confirm_password">Confirm Password</label>
  <input type="password" id="confirmpassword" name="confirm_password" placeholder="Confirm your password" onChange="remove_validation('confirmpassword','confirmpasswordErr');">
  <div class="error" id="confirmpasswordErr"></div>
  <br>
  <br>
  <br>


  <h2>Personal Details</h2>

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

  <div class="col-12 personal">

    <div class="col-4 gender">
    <label for="gender" id="gender">Gender</label>
	<input type="radio" id="male" value="0" name="male" >
	<h3 class="male">Male</h3>
  <div class="error" id="maleErr"></div>

	<input type="radio" id="female" value="1" name="male">
	<h3 class="male">Female</h3>
  <div class="error" id="femaleErr"></div>
    </div>

    
    <div class="col-4">
  <label for="date_birth">Date of Birth</label>
  <input type="date" id="dob" name="dob" class="dob" placeholder="Enter your date of birth" onChange="remove_validation('dob','dobErr');">
  <div class="error" id="dobErr"></div>
  </div>

  <div class="col-4">
  <label for="age">Age</label>
  <input type="text" id="age" name="age" class="age" onChange="remove_validation('age','ageErr');">
  <div class="error" id="ageErr"></div>
  </div>

  </div>

  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" onChange="remove_validation('phoneno','phonenoErr');">
  <div class="error" id="phonenoErr"></div>

    <label for="phone">WhatsApp Number</label>
  <input type="tel" id="whatsappphone" name="whatsapp_phone" class="whatsapp_phone" placeholder="Enter your whatsapp number" onChange="remove_validation('whatsapp','whatsappErr');">
  <div class="error" id="whatsappErr"></div>

  <label for="address">Street Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"></textarea>
  <div class="error" id="addressErr"></div>

  <label for="zip">Postal Code</label>
  <input type="text" id="zip" name="zip" class="pincode" placeholder="Enter your pincode" onChange="remove_validation('pincode','pincodeErr');">
  <div class="error" id="pincodeErr"></div>

  <label for="city">City</label>
  <input type="text" id="city" name="city" class="city" placeholder="Enter your city" onChange="remove_validation('cityname','cityErr');">
  <div class="error" id="cityErr"></div>


  <?php
  $select="SELECT `Id`, `Name` FROM `state` ";
  $statemnt=mysqli_query($conn,$select);

  if(mysqli_num_rows($statemnt)>0)
  {  
  
  ?>

  <label for="state" class="status">State</label>
  <select id="state" name="state">
    <option value="0">Select State</option>
    <?php   
    while($details=mysqli_fetch_assoc($statemnt))
    {
    ?>
    <option value="<?php echo $details["Id"];?>"><?php echo $details["Name"];?></option>

  <?php  }
  ?>
  </select>
  <?php  } ?>
  

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

    <footer>
    <div class="col-2">
      <h4>About Us</h4>
      <a href="#">Our Story</a>
    </div>
    <div class="col-2 text">
      <h4>Our Policies</h4>
      <a href="#">Shipping & Delivery</a><br>
      <a href="#">Returns & Exchanges</a><br>
      <a href="#">Privacy policy</a><br>
      <a href="#">Terms of service</a><br>
      <a href="#">GST & Billing</a>
    </div>
    <div class="col-2">
      <h4>Stores</h4>
      <a href="#">Location</a>
    </div>
    <div class="col-2 text">
      <h4>Connect</h4>
      <a href="#">Contact Us</a><br>
      <a href="#">Work With Us</a><br>
      <a href="#">Careers</a><br>
      <a href="#">Track Order</a>
    </div>
    
    <div class="col-4">
      <div class="newsletter-form">
    <p class="heading"> Subscribe to Our Newsletter</p>
    <form class="form">
      <input required="" placeholder="Enter your email address" name="email" id="email" type="email">
      <input value="Subscribe" type="submit">
    </form>
  </div>
  </div>
  
<ul class="wrapper">
  <li class="icon facebook">
    <span class="tooltip">Facebook</span>
    <svg
      viewBox="0 0 320 512"
      height="1.2em"
      fill="currentColor"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
      ></path>
    </svg>
  </li>
  <li class="icon twitter">
    <span class="tooltip">Twitter</span>
    <svg
      height="1.6em"
      fill="currentColor"
      viewBox="0 0 48 48"
      xmlns="http://www.w3.org/2000/svg"
      class="twitter"
    >
      <path
        d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429"
      ></path>
    </svg>
  </li>
  <li class="icon instagram">
    <span class="tooltip">Instagram</span>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      height="1.2em"
      fill="currentColor"
      class="bi bi-instagram"
      viewBox="0 0 16 16"
    >
      <path
        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
      ></path>
    </svg>
  </li>
</ul>

    </footer>
    <div class="cl"></div>
    <div class="copyright">© 2025, Milon, you accept the Terms & Conditions -
                           Privacy Policies.</div>
</body>



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
    alert("Please select your Gender.");
    valid = false;
  }

  // Date of birth
  let dob = document.getElementById("dob").value;
  let dobErr = document.getElementById("dobErr");
  if (dob === "") {
    dobErr.innerHTML = "Please select your date of birth.";
    valid = false;
  }

  // Age
  let age = document.getElementById("age").value.trim();
  let ageErr = document.getElementById("ageErr");
  if (age === "" || isNaN(age) || age <= 0) {
    ageErr.innerHTML = "Enter a valid age.";
    document.getElementById("age").style.border = "1px solid red";
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
    alert("Please select your country.");
    valid = false;
  }

   // state dropdown
  let state = document.getElementById("state").value;
  if (state === "0") {
    alert("Please select your state.");
    valid = false;
  }

  // Terms and Conditions checkbox
  let checkbox = document.getElementById("checkDefault");
  if (!checkbox.checked) {
    alert("You must agree to the Terms & Conditions before registering.");
    valid = false;
  }

  return valid;
  
}
</script>






</html>