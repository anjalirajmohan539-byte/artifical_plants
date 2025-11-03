<?php

include("database.php");

if(isset($_POST["button"]))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
}

$select="SELECT `Id`, `UserEmail`, `Lpassword`, `UserType` FROM `login` WHERE UserEmail='$email' AND Lpassword='$password'";
// var_dump($select);
$s_statement=mysqli_query($conn,$select);


if(mysqli_num_rows($s_statement)>0)

{
  header('location:index.php');
} 
else 
{
  echo "<script>alert('Invalid Email or Password!');</script>";
}



?>