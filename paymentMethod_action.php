<?php

include('database.php');

if(isset($_POST['btn']))
{
    $methodId = $_POST['methId'];
    $paymentId = $_POST['payid'];
    $method = $_POST['PaymentMethod'];

     if ($methodId != 0) {
        $update = "UPDATE `payment_method` SET `Name`='$method',`LastUpdate`=CURRENT_TIMESTAMP WHERE Id=$methodId";
        $ustatemnt=mysqli_query($conn,$update);
         if (!$ustatemnt) {
                echo "error2";
            } else {
                header("location:paymentMethod.php?methodId=$paymentId");
            }
    } else {

    $select = "SELECT `Id` FROM `payment_method` WHERE `Name` = '$method' AND `IsDeleted` = 0";
    if(!$check = mysqli_query($conn,$select))
    {
        echo "error1";
    }
    else
    {
        $insert = "INSERT INTO `payment_method`(`Name`, `CategoryId`) VALUES ('$method',$paymentId)";
        // var_dump($insert);
        $statement = mysqli_query($conn,$insert);

        if(!$statement)
        {
            echo "error2";
        }
        header("location:paymentMethod.php?methodId=$paymentId");
    }
}
}
elseif(isset($_POST['delete']))
{
    $mainId = $_POST['mainId'];
    $secondId = $_POST['secondId'];

     $dupdate = "UPDATE `payment_method` SET IsDeleted = 1 WHERE Id = $secondId";
    var_dump($dupdate);
    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) {
        echo "Error updating";
    } else {
        header("location:paymentMethod.php?methodId=$mainId");
        exit();
    }
}

?>