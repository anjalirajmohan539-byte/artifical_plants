<?php
include('database.php');
session_start();
if(isset($_SESSION['Id']))
    {
        $customerId = $_SESSION['Id'];
    }
$cartId = $_GET['cartId'];


$insert = "INSERT INTO `cart`(`ProductId`, `CustomerId`) 
           VALUES ($cartId,$customerId)";
$check = mysqli_query($conn,$insert);

if(!$check)
    {
        echo $error;
    }
    else
        {
            header('location:vase.php');
        }
?>