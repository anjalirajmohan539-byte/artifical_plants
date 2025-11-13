<?php
include('database.php');

if(isset($_POST['btn']))
{
    $name=$_POST['productType'];

    $select="SELECT `Id` FROM `material_category` WHERE Name='$name'";
    var_dump($select);

    if(!$statemnt=mysqli_query($conn,$select))
    {
        echo "error";
    }
    else
    {
        $insert="INSERT INTO `material_category`(`Name`, `Type`) VALUES ('$name')";
        var_dump($insert);
        $statement=mysqli_query($conn,$insert);

        if(!$statement)
        {
            echo "error2";
        }
        else
        {
            header('location:material_category.php');
        }
    }
}
?>