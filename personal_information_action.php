<?php
include('database.php');

if(isset($_POST['button']))
    {
        $id = $_POST['cusId'];
        $name = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        $update = "UPDATE `customer_details` SET 
                  `FullName`='$name',
                  `PhoneNo`='$phone',`Email`='$email',`Address`='$address' 
                  WHERE `CustomerId`= $id";
        $check = mysqli_query($conn,$update);

        if(!$check)
            {
                echo "error";
            }
            else
                {
                    header('location:personal_information.php');
                }
    }
?>