<?php

include('database.php');

if (isset($_POST['btn'])) 
    {
    $id = $_POST['mid'];
    $name = $_POST['productType'];

    if ($id != 0) {
        $update = "UPDATE `material_type` SET `Name`='$name',`LastUpdate`=CURRENT_TIMESTAMP WHERE Id=$id";
        $ustatemnt=mysqli_query($conn,$update);
         if (!$ustatemnt) {
                echo "error2";
            } else {
                header('location:product_material.php');
            }
    } else {

        $select = "SELECT `Id`  FROM `material_type` WHERE Name='$name'";
        var_dump($select);

        if (!$statemnt = mysqli_query($conn, $select)) {
            echo "error1";
        } else {
            $insert = "INSERT INTO `material_type`(`Name`) VALUES ('$name')";

            $statement = mysqli_query($conn, $insert);

            if (!$statement) {
                echo "error2";
            } else {
                header('location:product_material.php');
            }

        }
    }
}


elseif (isset($_POST['delete'])) 
{
    $id = $_POST['id'];

    $dupdate = "UPDATE material_type SET IsDeleted = 1 WHERE Id = $id";
    var_dump($dupdate);

    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) {
        echo "Error updating";
    } else {
        header("Location: product_material.php");
        exit();
    }
}

?>