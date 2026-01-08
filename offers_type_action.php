<?php

include('database.php');

if(isset($_POST['btn']))
{
    $name = $_POST['OffersTypes'];

    $select = "SELECT `Id`  FROM `offer_type` WHERE `Name` = '$name'";
    var_dump($select);
    if(!$check = mysqli_query($conn,$select))
    {
        echo "error1";
    }
    else
    {
        $insert = "INSERT INTO `offer_type`( `Name`) VALUES ('$name')";
        $statemnt = mysqli_query($conn,$insert);

        if(!$statemnt)
        {
            echo "error2";
        }
        else
        {
            header("location:offers_type.php");
        }
    }

}

?>