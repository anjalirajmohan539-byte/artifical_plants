<?php 

session_start();
include('database.php');
$emailerror="";
if(isset($_SESSION['error']))
{
	$emailerror=$_SESSION['error'];
	$_SESSION['error']="";
}


?>

<?php

include('header.php');

?>

<link href="css/login.css" rel="stylesheet">
    
    <div class="login-wrapper">
    <div class="login-box">
      <h2>Login</h2>
      <p>Don't have an account yet? <a href="registratin_form.php">Create account</a></p>

      <form action="login_action.php" method="post" onSubmit="return validation();">
        <input type="email" id="email" class="email" name="email" placeholder="Email" onChange="removeValidation('email','emailErr');">
        <div class="error" id="emailErr"></div>
        <input type="password" id="password" class="password" name="password" placeholder="Password" onChange="removeValidation('password','passwordErr');">
        <div class="error" id="passwordErr"></div>
        <a href="forgot_password.php" class="forgot">Forgot your password?</a>
        <button type="submit" name="button" class="button">Sign In</button>
      </form>

      <a href="index.php" class="return">Return to Store</a>
    </div>
  </div>

  <?php

include('footer.php');

?>
</body>

<script>
function validation()
{
  let email = document.getElementById("email");
  let password = document.getElementById("password");
  let emailErr = document.getElementById("emailErr");
  let passwordErr = document.getElementById("passwordErr");
  let valid = true;

  emailErr.textContent = "";
  passwordErr.textContent = "";
  document.getElementById("email").style.border = "";
  document.getElementById("password").style.border = "";

  if (email.value.trim() === "") {
    emailErr.textContent = "Enter your email";
    document.getElementById("email").style.border = "1px solid red";
    valid = false;
  }

  if (password.value.trim() === "") {
    passwordErr.textContent = "Enter your password";
    document.getElementById("password").style.border = "1px solid red";
    valid = false;
  }

  return valid; 
}



function removeValidation(inputId, errorId) 
{
  document.getElementById(errorId).textContent = "";
  document.getElementById(inputId).style.border = "";
}
</script>


</html>