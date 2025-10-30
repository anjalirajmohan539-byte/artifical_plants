<?php

include("database.php");

if(isset($_POST["button"]))
{
    $email=$_POST("email");
    $password=$_POST("password");
}

$select="SELECT `Id`, `UserEmail`, `Password`, `UserType` FROM `login` WHERE UserEmail='$email' AND Lpassword='$password'";

if (!$s_statement=mysqli_query($conn,$select))
	{
		echo "error";
	}
	else
	{
		if(mysqli_num_rows($s_statement)<1)
		{
			$_SESSION['error']="incorrect email or password";
			header('location:login_action.php');
		}
		else
		{
			$l_array=mysqli_fetch_array($s_statement);
			$usertype=$l_array['UserType'];
			$login_id=$l_array['Id'];
			
			$_SESSION['id']=$login_id;
			
			if($usertype=="admin")
			{
				
			}
			
			
		}
	}

?>