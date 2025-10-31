<?php
include("database.php");
?>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/registration_form.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <!-- <div class="usecode">
        <p>Use code PREPAID5 – Get 5% OFF on prepaid orders above ₹2000!</p>
    </div> -->
    <div class="header">

        <div class="col-3 search">     
  <div class="input-container">
    <input type="text" name="text" class="input" placeholder="Search something...">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
    </div>

        </div>
        <div class="col-3">
            <h1 class="text-light">MILON</h1>
            <p class="text-body-secondary">Artifical Flowers and Home Decors</p>
        </div>
        <div class="col-3">
            <a href="signup.html"><img src="images/contact.png"></a>
            <a href="#"><img src="images/shopping-cart.png"></a>
        </div>
    </div>
    <div class="menu">
        <a href="#" class="text-light">HOME</a>
        <a href="#" class="text-light">NEW ARRIVALS</a>
        <a href="#" class="text-light">DECOR</a>
        <a href="#" class="text-light">ARTIFICAL FLOWERS</a>
        <a href="#" class="text-light">VASE</a>
        <a href="#" class="text-light">PEBBLES & MOSS</a>
        <a href="#" class="text-light">BLOG</a>
    </div>

    <div class="cl"></div>
     <div class="reg-wrapper">
    <div class="reg-box">
      <form action="#" method="post" enctype="multipart/form-data" onSubmit="return validation();">


  <h2>Account Details</h2>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" class="email" placeholder="Enter your email" oninput="remove_validation('email','emailErr');">

   <label for="password">Password</label>
  <input type="password" id="password" name="password" class="password" placeholder="Enter your password" oninput="remove_validation('password','passwordErr');">

  <label for="confirm_password">Confirm Password</label>
  <input type="password" id="confirmpassword" name="confirm_password" placeholder="Confirm your password" oninput="remove_validation('confirmpassword','confirmpasswordErr');">
  <br>
  <br>
  <br>


  <h2>Personal Details</h2>

<aside class="card-right">
<div class="avatar-preview" id="avatarBox">
        <div style="text-align:center;padding:10px;color:var(--muted)">
          <div style="font-size:18px;font-weight:700">Welcome!</div>
          <div class="small1">Upload a profile photo to preview here.</div>
        </div>
      </div>
     
</aside>

  <label for="customer_image"></label>
   <div class="small">Upload a square photo (will be cropped).</div>
  <input id="avatar" type="file" class="image" name="image">

   <label for="fullname">Full Name</label>
  <input type="text" id="fullname" name="fullname" class="fullname" placeholder="Enter your full name" oninput="remove_validation('fullname','fullnameErr');">

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
  <input type="date" id="dob" name="dob" class="dob" placeholder="Enter your date of birth" oninput="remove_validation('dob','dobErr');">
  </div>

  <div class="col-4">
  <label for="age">Age</label>
  <input type="text" id="age" name="age" class="age" oninput="remove_validation('age','ageErr');">
  </div>

  </div>

  <label for="phone">Phone Number</label>
  <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone number" oninput="remove_validation('phoneno','phonenoErr');">

    <label for="phone">WhatsApp Number</label>
  <input type="tel" id="whatsappphone" name="whatsapp_phone" class="whatsapp_phone" placeholder="Enter your whatsapp number" oninput="remove_validation('whatsapp','whatsappErr');">

  <label for="address">Street Address</label>
  <textarea id="address" name="address" class="address" placeholder="Enter your address" onkeyup="remove_validation('address','addressErr')"></textarea>

  <label for="zip">Postal Code</label>
  <input type="text" id="zip" name="zip" class="pincode" placeholder="Enter your pincode" oninput="remove_validation('pincode','pincodeErr');">

  <label for="city">City</label>
  <input type="text" id="city" name="city" class="city" placeholder="Enter your city" oninput="remove_validation('cityname','cityErr');">


  <?php
  $select="SELECT `Id`, `Name` FROM `state` ";
  $statemnt=mysqli_query($conn,$select);

  if(mysqli_num_rows($statemnt)>0)
  {  
  
  ?>

  <label for="state" class="status">State</label>
  <select name="state">
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

<script>

function validation() {
  let valid = true;

  // Helper function
  function showError(id, msg) {
    let el = document.getElementById(id + "Err");
    if (el) el.textContent = msg;
    valid = false;
  }

  // Clear error text
  document.querySelectorAll(".error").forEach(e => e.textContent = "");

  // Get values
  let email = document.getElementById("email").value.trim();
  let password = document.getElementById("password").value.trim();
  let confirmpassword = document.getElementById("confirmpassword").value.trim();
  let fullname = document.getElementById("fullname").value.trim();
  let dob = document.getElementById("dob").value.trim();
  let age = document.getElementById("age").value.trim();
  let phone = document.getElementById("phone").value.trim();
  let address = document.getElementById("address").value.trim();
  let zip = document.getElementById("zip").value.trim();
  let city = document.getElementById("city").value.trim();
  let check = document.getElementById("checkDefault").checked;

  // Email
  if (email === "") showError("email", "Email is required");
  else if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email))
    showError("email", "Invalid email format");

  // Password
  if (password === "") showError("password", "Password is required");
  else if (password.length < 6) showError("password", "Min 6 characters");

  // Confirm password
  if (confirmpassword === "") showError("confirmpassword", "Please confirm password");
  else if (confirmpassword !== password)
    showError("confirmpassword", "Passwords do not match");

  // Full name
  if (fullname === "") showError("fullname", "Full name is required");

  // DOB
  if (dob === "") showError("dob", "Date of birth is required");

  // Age
  if (age === "" || isNaN(age) || age <= 0)
    showError("age", "Enter a valid age");

  // Phone
  if (phone === "" || !/^[0-9]{10}$/.test(phone))
    showError("phoneno", "Enter a valid 10-digit phone");

  // Address
  if (address === "") showError("address", "Address is required");

  // Zip
  if (zip === "" || !/^[0-9]{6}$/.test(zip))
    showError("pincode", "Enter valid 6-digit pincode");

  // City
  if (city === "") showError("cityname", "City name is required");

  // Terms checkbox
  if (!check) {
    alert("Please agree to Terms & Conditions");
    valid = false;
  }

  return valid;
}

// To clear error when typing
function remove_validation(inputId, errorId) {
  document.getElementById(errorId)?.textContent = "";
}

</script>
</html>