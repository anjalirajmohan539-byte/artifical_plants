<?php
include('database.php');

$productId = isset($_GET['pId']) ? $_GET['pId'] : '';
$customerId = isset($_GET['customer']) ? $_GET['customer'] : '';
$rowId = isset($_GET['rId']) ? $_GET['rId'] : '';


$selectQuere = "SELECT `Id` FROM `wishlist` WHERE `ProductId` = $productId  AND `CustomerId` = $customerId  AND `IsDelete` = 0";
// var_dump($selectQuere);
$check = mysqli_query($conn,$selectQuere);

if(mysqli_num_rows($check)>0)
    {
        echo "error";


        $selectQuere2 = "SELECT `Id` FROM `wishlist` WHERE Favorite = 1 AND Id = $rowId";
        $check2 = mysqli_query($conn, $selectQuere2);

    if (mysqli_num_rows($check2) > 0) {

        $update1 = "UPDATE `wishlist` SET `Favorite`=0 WHERE Id=$rowId";
        if (mysqli_query($conn, $update1)) {
            echo "Favourate deleted";
        }
    } else {

        $update = "UPDATE `wishlist` SET `Favorite`=1 WHERE Id=$rowId";
        if (mysqli_query($conn, $update)) {
            echo "Favourate readded";
        }
    }
} else {
    $query = "INSERT INTO `wishlist` (`CustomerId`, `ProductId`) VALUES ($customerId,$productId)";
    if (!mysqli_query($conn, $query)) {

        echo "error";
    }
}

?>