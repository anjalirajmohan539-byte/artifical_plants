<?php
include('database.php');

if(isset($_POST['btn']))
    {
        $Id = $_POST['editId'];
        $customerId = $_POST['customerId'];
        $name = $_POST['fullName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $pincode = $_POST['Pincode'];
        $place = $_POST['Place'];
        $status = $_POST['status'];

        if($customerId !=0)
            {
                
            }

        if($Id <> 0 )
            {
                $update1 = "UPDATE `delivery_customer_details` SET  
                `Status`= 1 WHERE `Customer_Id`=$customerId";
                $updatecheck1 = mysqli_query($conn,$update1);

                $update2 = "UPDATE `delivery_customer_details` SET 
                `Name`='$name',
                `Address`='$address',
                `PhoneNo`='$phone',
                `Pincode`=$pincode,
                `Place`='$place',
                `Status`= $status WHERE `Id`=$Id";
                $updatecheck2 = mysqli_query($conn,$update2);

                if(!$updatecheck2)
                    {
                        echo "error";
                    }
                    else
                        {
                            header("location:shipping_customer_details.php");
                        }
            }
            else
                {
        $select = "SELECT Id FROM `customer_details` WHERE `Address` = '$address'";
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
        $stmt = $conn->prepare("INSERT INTO `delivery_customer_details`(`Customer_Id`, `Name`, `Address`, `PhoneNo`, `Pincode`, `Place`, `Status`) 
                   VALUES (?,?,?,?,?,?,?)");

         $stmt->bind_param("isssiss",$customerId,$name,$address,$phone,$pincode,$place,$status);
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
}
?>