<?php
include('database.php');
session_start();

if(isset($_SESSION['Id']))
{
    $customerId = $_SESSION['Id'];
}
else
{
    die("Login required");
}

$cartId    = $_GET['cartId'];
$productId = $_GET['productId'];
$category  = $_GET['categoryId'];

$select = "SELECT `Id`,`Status` FROM `cart` WHERE `IsDeleted` = 0 AND `ProductId` = $productId  AND `CustomerId` = $customerId";
var_dump($select);
$checkselect = mysqli_query($conn, $select);

if(mysqli_num_rows($checkselect) > 0)
{

    $row = mysqli_fetch_assoc($checkselect);

    if($row['Status'] == 1)
    {
        $update = "UPDATE `cart` SET `Status` = 0 WHERE `Id` = ".$row['Id'];
        mysqli_query($conn, $update);

        header('location:vase.php?categoryId='.$category);
    }
    else
    {
        $update = "UPDATE `cart` SET `Status` = 1 WHERE `Id` = ".$row['Id'];
        mysqli_query($conn, $update);

        header('location:vase.php?categoryId='.$category);
    }
}
else
{
    $insert = "INSERT INTO `cart`(`ProductId`, `CustomerId`, `Status`) VALUES ($productId, $customerId, 0)";
    $check = mysqli_query($conn, $insert);

    if(!$check)
    {
        echo "Error";
    }
    else
    {
        header('location:vase.php?categoryId='.$category);
    }
}
?>