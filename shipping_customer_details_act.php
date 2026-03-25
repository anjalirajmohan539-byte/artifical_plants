<?php
include('database.php');

if(isset($_POST['btn']))
    {
        echo $Id = $_POST['editId'];
        $customerId = $_POST['customerId'];
        $name = $_POST['fullName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $pincode = $_POST['Pincode'];
        $place = $_POST['Place'];
        $status = $_POST['status'];

        if($customerId !=0)
            {
                 $select = "SELECT Id FROM `delivery_customer_details` WHERE `Customer_Id` = $customerId";
                 var_dump($select);
        $check1 = mysqli_query($conn,$select);

        if(mysqli_num_rows($check1)>0)
            {
$update1 = "UPDATE `delivery_customer_details` SET  
                `Status`= 1 WHERE `Customer_Id`=$customerId";
                $updatecheck1 = mysqli_query($conn,$update1);

            }
            }

        if($Id <> "" )
            {
                
                $update2 = "UPDATE `delivery_customer_details` SET 
                `Name`='$name',
                `Address`='$address',
                `PhoneNo`='$phone',
                `Pincode`=$pincode,
                `Place`='$place',
                `Status`= $status WHERE `Id`=$Id";
                var_dump($update2);
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
        $insert = "SELECT Id FROM `customer_details` WHERE `Address` = '$address'";
        $check2 = mysqli_query($conn,$insert);
        
        if(!$check2)
{
	echo 'error';
}
else
{
	if(mysqli_num_rows($check2)>0)
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