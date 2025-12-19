<?php
include("database.php");

if(isset($_POST['btn']))
{
    $payment = $_POST['Payment'];

    $select = "SELECT `Id` FROM `payment_category` WHERE Name = '$payment'";

    if($check = mysqli_query($conn,$select))
    {
        echo "error1";
    }
    else
    {

    $insert = "INSERT INTO `payment_category`(`Name`) VALUES ('$payment')";
    $statemnt = mysqli_query($conn,$insert);
    var_dump($insert);

    if(!$statemnt)
    {
        echo "error2";
    }
    else
    {
        header("location:paymentCategory.php");
    }
     }
}
?>