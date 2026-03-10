<?php
include('database.php');

if(isset($_POST['btn']))
    {
        $name = $_POST['fullName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $pincode = $_POST['Pincode'];
        $place = $_POST['Place'];
        $status = $_POST['status'];

        $select = "SELECT * FROM `customer_details` WHERE `Address` = '$address'";
        $check = mysqli_query($conn,$select);
        
        if(!$check)
{
	echo 'error';
}
else
{
	if(mysqli_num_rows($check)>0)
	{
		echo "already in";
	}
	else
	{
        $stmt = $conn->prepare("INSERT INTO `delivery_customer_details`( `Name`, `Address`, `PhoneNo`, `Pincode`, `Place`, `Status`) 
                   VALUES (?,?,?,?,?,?)");

         $stmt->bind_param("ssssss",$name,$address,$phone,$pincode,$place,$status);
            if($stmt->execute())
            {
                header("location:shipping_customer_details.php");
            }
            else
            {
                echo "Error";
            }
    }
     }
    }

?>