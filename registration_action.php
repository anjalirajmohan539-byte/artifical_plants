<?php

 include("database.php");

 if(isset($_POST["button"]))
 {
   $email=$_POST['email'];
   $password=$_POST['password'];
   $image=$_FILES['image']['name'];
   $name=$_POST["fullname"];
   $gender=$_POST["male"];
   $dob=$_POST["dob"];
   $phone=$_POST["phone"];
   $whatsapp=$_POST["whatsapp_phone"];
   $address=$_POST["address"];
   $pincode=$_POST["zip"];
   $city=$_POST["city"];
   $state=$_POST["state"];
   $country=$_POST["country"];

 }


 $select="SELECT `Id` FROM `login` WHERE UserEmail='$email'";
$statement_select=mysqli_query($conn,$select);


if(!$statement_select)
{
	echo 'error';
}
else
{
	if(mysqli_num_rows($statement_select)>0)
	{
		echo "already in";
	}
	else
	{
      $select_login="INSERT INTO `login`(`UserEmail`, `Lpassword`, `UserType`) VALUES ('$email','$password',2)";
		$statement_select_login=mysqli_query($conn,$select_login);

      var_dump($select_login);
		
		if(!$statement_select_login)
		{
			echo "error1";
		}
		else
		{
				
			$id=mysqli_insert_id($conn);

         $register="INSERT INTO `customer_details`(`CustomerId`, `FullName`, `PhoneNo`, `WhatsappNo`, `Email`, `Password`, `DOB`,`Gender`, `Address`, `City`, `State`, `PinCode`, `Country`, `status`) 
		 VALUES ('$id','$name','$phone','$whatsapp','$email','$password','$dob','$gender','$address','$city','$state',$pincode,'$country',1)";
			
			var_dump($register);
			$statement_register=mysqli_query($conn,$register);
			
			
			if(!$statement_register)
			{
				echo "error2";
			}
			else
			{
				$c_path="images/img";
				$c_pic=$c_path.basename($image);
				echo $c_pic;
				
				if(move_uploaded_file($_FILES['img']['tmp_name'],$c_pic))
				{
					header('location:index.php');
				}
				else
				{
					echo "already exists";
				}
				
			}
		}
	}
}

?>