<?php
include("database.php");

if(isset($_POST['btn']))
{
    $categoryId = $_POST['catid'];
    $payment = $_POST['Payment'];

  if ($categoryId != 0) {
        $update = "UPDATE `payment_category` SET `Name`='$payment',`LastUpdate`=CURRENT_TIMESTAMP WHERE Id=$categoryId";
        $ustatemnt=mysqli_query($conn,$update);
         if (!$ustatemnt) {
                echo "error2";
            } else {
                header('location:paymentCategory.php');
            }
    } else {

         $select = "SELECT `Id`  FROM `payment_category` WHERE Name='$payment'";
        var_dump($select);

        if (!$statemnt = mysqli_query($conn, $select)) {
            echo "error1";
        } else {
            $insert = "INSERT INTO `payment_category`(`Name`) VALUES ('$payment')";

            $statement = mysqli_query($conn, $insert);

            if (!$statement) {
                echo "error2";
            } else {
                header('location:paymentCategory.php');
            }

        }
        }
}

elseif(isset($_POST['delete']))
{
    $categoryId = $_POST['cateId'];

    $dupdate = "UPDATE payment_category SET IsDeleted = 1 WHERE Id = $categoryId";
    var_dump($dupdate);

    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) {
        echo "Error updating";
    } else {
        header("Location: paymentCategory.php");
        exit();
    }
}
?>